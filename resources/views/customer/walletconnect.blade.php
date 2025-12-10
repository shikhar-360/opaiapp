{{-- @vite('resources/js/wallet.js') --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
Connecting your wallet
<h1>Hello, {{ $customer->name }}!</h1>
<p>Your email is: {{ $customer->email }}</p>
<p>Your App ID is: {{ $customer->app_id }}</p>
<p>Your Wallet Address is: {{ $customer->wallet_address }}</p>


<div><center><button id="connectWalletBtn" data-required-address="{{ $customer->wallet_address ?? '' }}">Connect Wallet</button></center></div>


<script type="module">
import {EthereumClient,w3mConnectors,w3mProvider,WagmiCore,WagmiCoreChains} from 'https://unpkg.com/@web3modal/ethereum@2.6.2'
import { Web3Modal } from 'https://unpkg.com/@web3modal/html@2.6.2'
// If you use Viem for signing, keep this:
// import * as viem from 'https://esm.sh/viem@2.21.3' 


const { configureChains, createConfig, getAccount, getWalletClient } = WagmiCore
const { polygon } = WagmiCoreChains

const chains = [ polygon]
const projectId = 'c2db982217ae681082036c7f734ca146'

// Shim for userAgentData compatibility
try {
    const nav = window.navigator
    if (!nav.userAgentData || !Array.isArray(nav.userAgentData.brands)) {
        nav.userAgentData = { brands: [] }
    }
} 
catch {}

const { publicClient } = configureChains(chains, [w3mProvider({ projectId })])
const wagmiConfig = createConfig({
    autoConnect: false, // Set to false to manage connection manually
    connectors: w3mConnectors({ projectId, chains }),
    publicClient
})
const ethereumClient = new EthereumClient(wagmiConfig, chains)
const web3modal = new Web3Modal({ projectId, enableExplorer: false }, ethereumClient)


// --- Helper Functions ---

// FIX: Helper function to wait for connection status change using polling/modal events
function waitForConnection() {
    return new Promise((resolve, reject) => {
        // Use an interval to poll the connection status after the modal is opened
        const intervalId = setInterval(() => {
            const { isConnected } = getAccount();
            if (isConnected) {
                clearInterval(intervalId);
                resolve();
            }
        }, 300); // Check every 300ms

        // If the modal is closed manually before connecting, stop the promise
        const unsubscribeModal = web3modal.subscribeModal(({ open }) => {
           if (!open && !getAccount().isConnected) {
               clearInterval(intervalId); // Stop the polling interval
               unsubscribeModal(); // Stop listening to modal events
               reject(new Error('Modal closed without connection.'));
           }
        });
    });
}

async function signAndVerifyOwnership(address) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // 1. Get the Nonce from Laravel API
    const nonceResponse = await fetch('/customer/wallet/nonce');
    const { nonce } = await nonceResponse.json();

    // 2. Sign the nonce using Viem
    const walletClient = await getWalletClient(); // Helper from WagmiCore
    const signature = await walletClient.signMessage({
        account: address,
        message: nonce,
    });

    // 3. Send signature back to Laravel for Verification
    const verifyResponse = await fetch('/customer/wallet/verify-ownership', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ 
            wallet_address: address,
            signature: signature
        })
    });
    
    const data = await verifyResponse.json();
    
    if (data.success) {
        alert(data.message);
        window.location.href = '/customer/dashboard'; // Redirect to dashboard
    } else {
        alert(data.message);
    }
}


// --- Main Login/Connection Handler ---

async function handleLogin() {
    // Get the required address specified in the Blade template
    const connectBtn = document.getElementById('connectWalletBtn');
    const requiredAddress = connectBtn ? connectBtn.dataset.requiredAddress : null;

    let { address, isConnected } = getAccount();

    if (!isConnected) {
        try {
            await web3modal.openModal(); 
            await waitForConnection(); // Wait for user action
            ({ address, isConnected } = getAccount()); // Update variables after connection
            
        } catch (error) {
            console.error("Connection process aborted or failed:", error.message);
            alert("Connection failed. Please try again.");
            return; 
        }
    }

    // After ensuring connection and address availability
    if (isConnected && address) {
        alert("Wallet connected: " + address);

        // UX Check: Ensure connected address matches required address
        // Only run this if a specific address was provided by the backend
        if (requiredAddress && address.toLowerCase() !== requiredAddress.toLowerCase()) {
            alert(`Error: Connected wallet address does not match the required address.`);
            return; 
        }

        // Proceed to the secure signature verification step
        await signAndVerifyOwnership(address);

    } else {
        alert("Something went wrong. Failed to get address.");
    }
}


// --- DOM Ready Event Listener ---
document.addEventListener('DOMContentLoaded', (event) => {
    const connectBtn = document.getElementById('connectWalletBtn');
    if (connectBtn) {
        connectBtn.addEventListener('click', handleLogin);
    }
});

</script>