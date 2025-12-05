<?php
namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Services\P2PTransferService;

class P2PTransferController extends Controller
{
    protected $p2p_transfer_services;

    public function __construct(P2PTransferService $p2p_transfer_service)
    {
        $this->p2p_transfer_services = $p2p_transfer_service;
    }

    public function showForm()
    {
        return view('customer.transfer.form');
    }

    public function p2pTransfer(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'wallet_address' => 'required|exists:customers,wallet_address',
            'amount'     => 'required|numeric'
        ]);

        $payerUserId = $customer->id; 
        
        // The service method expects a User/CustomersModel instance, a string, and a float
        try {
            // The service method you need to call is named 'transfer', not 'transferToTeamMember'
            $p2ptransfer = $this->p2p_transfer_services->transferToTeamMember(
                                                                            $customer, 
                                                                            $validated['wallet_address'],
                                                                            $validated['amount']
                                                                        );
            return redirect()
                    ->route('customer.transfer.form')
                    ->with('success', $p2ptransfer);
        } 
        catch (Exception $e) {
            // If any validation fails (insufficient funds, not a downline member, etc.)
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
