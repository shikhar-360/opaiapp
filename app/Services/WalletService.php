<?php

namespace App\Services;

use App\Models\CustomersModel;
use Elliptic\EC;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use kornrunner\Keccak;
use Exception;

class WalletService
{
    /**
     * Generate a unique nonce for a given user model and save it to the database.
     *
     * @param Model $user
     * @return string The generated nonce
     */
    public function generateNonce(Model $user): string
    {
        $nonce = Str::random(32);
        $user->nonce = $nonce;
        $user->save();
        return $nonce;
    }

    /**
     * Verify the wallet signature and ownership.
     *
     * @param string $walletAddress
     * @param string $signature
     * @param Model $user
     * @return bool True if verification is successful, false otherwise.
     * @throws Exception If verification fails unexpectedly.
     */
    public function verifyOwnership(string $walletAddress, string $signature, Model $user): bool
    {
        // Check if the provided address matches the user's stored address AND the nonce is recent/valid
        // if (strtolower($user->wallet_address) !== strtolower($walletAddress) || !$user->nonce) {
        //     throw new Exception('Mismatched address or invalid session.');
        // }

        if (!empty($user->wallet_address) && strtolower($user->wallet_address) !== strtolower($walletAddress)) {
            throw new Exception('The connected wallet address does not match the address already linked to this account.');
        }
        
        $message = $user->nonce;
        if (!$message) {
            throw new Exception('Invalid session: Nonce missing or expired.');
        }
        
        try {
            $messageLen = strlen($message);
            $hashedMessage = Keccak::hash("\x19Ethereum Signed Message:\n" . $messageLen . $message, 256);

            $ec = new EC('secp256k1');
            $r = substr($signature, 2, 64);
            $s = substr($signature, 66, 64);
            $v_hex = substr($signature, 130, 2); 
            $v = hexdec($v_hex);

            if ($v >= 27) {
                $v -= 27;
            }

            $publicKey = $ec->recoverPubKey($hashedMessage, ['r' => $r, 's' => $s], $v);
                       
            $publicKeyHex = $publicKey->encode('hex');
            $publicKeyHexStripped = substr($publicKeyHex, 2); 
            $verifiedAddress = '0x' . substr(Keccak::hash(hex2bin($publicKeyHexStripped), 256), 24);

            if (strtolower($verifiedAddress) !== strtolower($walletAddress)) {
                throw new Exception('Signature verification failed: Recovered address mismatch.');
            }

            // Success! The user owns the wallet. Clear the nonce and save.
            if (empty($user->wallet_address) || empty($user->referral_code)) {
                $user->wallet_address = $walletAddress;
                $lastSix = substr($walletAddress, -6);
                $user->referral_code = $lastSix;
                // You might add a 'is_verified' flag here as well
            }
            $user->nonce = null;
            $user->save();
            
            return true;

        } catch (Exception $e) {
            // Re-throw the exception with a clean message for the caller to handle
            throw new Exception('Verification failed: ' . $e->getMessage());
        }
    }
}
