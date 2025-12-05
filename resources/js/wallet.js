/**
 * Handles connecting to an Ethereum wallet provider (like MetaMask).
 *
 * This file is intended to be bundled by Vite and included in your Blade view
 * using the @vite(['resources/js/app.js', 'resources/js/wallet.js']) directive.
 */

// Define the function that attempts to connect the wallet
async function connectWallet() {
    // Check if the Ethereum provider is available in the browser (e.g., MetaMask installed)
    if (typeof window.ethereum !== 'undefined') {
        try {
            alert('Ethereum provider found. Requesting accounts...');
            
            // Request account access from the user. This triggers the MetaMask popup.
            const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' });
            
            // The request returns an array of accounts, we usually use the first one
            const walletAddress = accounts[0]; 

            if (walletAddress) {
                alert('Wallet connected:', walletAddress);
                
                // Now, send this address to your Laravel backend to save it
                await saveWalletAddressToBackend(walletAddress);
                
            } else {
                alert('No accounts selected.');
            }

        } catch (error) {
            // Handle errors (e.g., user rejects connection)
            console.error("Wallet connection failed:", error);
            alert('Could not connect wallet. ' + (error.message || 'Please try again.'));
        }
    } else {
        // Alert user if no provider is installed
        alert('MetaMask or another web3 wallet is not installed. Please install one to proceed.');
        // Optionally redirect to Metamask download page
        // window.location.href = "";
    }
}

// Function to send the wallet address securely to the Laravel backend
async function saveWalletAddressToBackend(address) {
    try {
        // You need the CSRF token available in your view to send a POST request
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        const response = await fetch('/customer/save-wallet', { // Use the correct API endpoint URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken 
            },
            body: JSON.stringify({ wallet_address: address })
        });
        
        if (!response.ok) {
            throw new Error('Failed to save wallet address on the server.');
        }

        const data = await response.json();
        
        if (data.success) {
            alert(data.message);
            // Redirect the user to the dashboard after successful connection
            window.location.href = '/customer/dashboard'; 
        } else {
            alert('Server error saving address.');
        }

    } catch (error) {
        console.error("Backend API call failed:", error);
        alert("There was an issue saving your wallet address to your profile.");
    }
}

// Event listener to attach the connect function to a button click
document.addEventListener('DOMContentLoaded', (event) => {
    const connectBtn = document.getElementById('connectWalletBtn');
    if (connectBtn) {
        connectBtn.addEventListener('click', connectWallet);
    }
});
