<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\customer\CustomerAuthController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\customer\DepositController;
use App\Http\Controllers\customer\WithdrawController;
use App\Http\Controllers\customer\P2PTransferController;
use App\Http\Controllers\Customer\Topup9PayController;

// Registration
Route::get('/register/{sponsorcode?}', [CustomerAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [CustomerAuthController::class, 'register'])->name('register.submit');

// Login
Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomerAuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [CustomerAuthController::class, 'logout'])->name('logout');

Route::middleware(['customer'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard'); //fn () => view('index'))->name('index');
    Route::get('/profile', [CustomerController::class, 'showProfile'])->name('profile'); //fn () => view('profile'))->name('profile');
    Route::post('/profile', [CustomerController::class, 'saveProfile'])->name('customer.profile.save'); //fn () => view('profile'))->name('profile');
    Route::get('/staking', [DepositController::class, 'showForm'])->name('deposit.form'); //fn () => view('staking'))->name('staking');
    
    Route::get('/directs', [CustomerController::class, 'showDirects'])->name('directs'); //fn () => view('staking'))->name('staking');
    Route::get('/team', [CustomerController::class, 'showMyTeam'])->name('team'); //fn () => view('staking'))->name('staking');
    Route::get('/genealogy', [CustomerController::class, 'showGenealogy'])->name('genealogy'); //fn () => view('staking'))->name('staking');

    Route::get('/pay-qr', [Topup9PayController::class, 'showForm'])->name('pay.qr');
    Route::post('/pay-qr', [Topup9PayController::class, 'topup'])->name('pay.qr.save');

    Route::get('/pay-topup', [DepositController::class, 'showForm'])->name('pay.topup');
    Route::post('/pay-topup', [DepositController::class, 'deposit'])->name('pay.topup.save');
    // Route::get('/pay-qr', [Topup9PayController::class, 'showQRForm'])->name('pay.qr');

    // Route::get('/bond', fn () => view('bond'))->name('bond');
    // Route::get('/swap', fn () => view('swap'))->name('swap');
    // Route::get('/public-alliance', fn () => view('public_alliance'))->name('public-alliance');
    // Route::get('/pool-reward', fn () => view('pool_reward'))->name('pool-reward');
    // Route::get('/account', fn () => view('account'))->name('account');
    // Route::get('/turbine-list', fn () => view('turbine_list'))->name('turbine-list');
    // Route::get('/pay-dapp', fn () => view('pay_dapp'))->name('pay.dapp');
    // Route::get('/pay-qr', fn () => view('pay_qr'))->name('pay.qr');
    // Route::get('/pay-topup', fn () => view('pay_topup'))->name('pay.topup');
    // Route::get('/directs', fn () => view('directs'))->name('directs');
    // Route::get('/team', fn () => view('team'))->name('team');

});


// Route::get('/dashboard', fn () => view('customer.dashboard'))->name('dashboard');
// Route::get('/profile', fn () => view('customer.profile'))->name('profile');
Route::get('/staking', fn () => view('customer.staking'))->name('staking');
Route::get('/login', fn () =>  view('customer.login'))->name('login');
Route::get('/register', fn () =>  view('customer.register'))->name('register');
Route::get('/withdraw', fn () => view('customer.withdraw'))->name('withdraw');




Route::view('/index', 'pages.index')->name('index');

// Route::get('/dashboard', fn () => view('index'))->name('index');
// Route::get('/profile', fn () => view('profile'))->name('profile');
// Route::get('/staking', fn () => view('staking'))->name('staking');
// Route::get('/bond', fn () => view('bond'))->name('bond');
// Route::get('/swap', fn () => view('swap'))->name('swap');
// Route::get('/public-alliance', fn () => view('public_alliance'))->name('public-alliance');
// Route::get('/pool-reward', fn () => view('pool_reward'))->name('pool-reward');
// Route::get('/account', fn () => view('account'))->name('account');
// Route::get('/turbine-list', fn () => view('turbine_list'))->name('turbine-list');
Route::get('/pay-dapp', fn () => view('pay_dapp'))->name('pay.dapp');
// Route::get('/pay-qr', fn () => view('pay_qr'))->name('pay.qr');
// Route::get('/pay-topup', fn () => view('pay_topup'))->name('pay.topup');
// Route::get('/directs', fn () => view('directs'))->name('directs');
// Route::get('/team', fn () => view('team'))->name('team');
// Route::get('/genealogy', function () {

//     $data['data']['data'] = [
//         [
//             "refferal_code" => "A001",
//             "rank" => "Gold",
//             "currentPackageDate" => "2024-01-01",
//             "my_team" => 10,
//             "my_direct" => 5,
//             "team_investment" => 1000,
//             "direct_investment" => 500,
//             "totalInvestment" => 200,
//             "children" => [
//                 [
//                     "refferal_code" => "B001",
//                     "rank" => "Silver",
//                     "currentPackageDate" => "2024-01-02",
//                     "my_team" => 4,
//                     "my_direct" => 2,
//                     "team_investment" => 400,
//                     "direct_investment" => 150,
//                     "totalInvestment" => 100,
//                     "children" => [
//                         [
//                             "refferal_code" => "C001",
//                             "rank" => "Bronze",
//                             "currentPackageDate" => "2024-01-03",
//                             "my_team" => 1,
//                             "my_direct" => 1,
//                             "team_investment" => 100,
//                             "direct_investment" => 50,
//                             "totalInvestment" => 20,
//                             "children" => []
//                         ]
//                     ]
//                 ]
//             ]
//         ]
//     ];

//     return view('genealogy', $data);
// })->name('genealogy');

Route::get('/overview', fn () => view('overview'))->name('overview');
// Route::get('/withdraw', fn () => view('withdraw'))->name('withdraw');
Route::get('/tickets', fn () => view('tickets'))->name('tickets');
// Route::get('/login', fn () =>  view('login'))->name('login');
// Route::get('/register', fn () =>  view('register'))->name('register');









    
    
    // Route::get('/web3login', [CustomerAuthController::class, 'web3Login'])->name('web3login');

    // // Protected dashboard
    // Route::middleware(['auth:customer'])->group(function () {
    //     // Route::get('/web3login', [CustomerAuthController::class, 'web3Login'])->name('web3login');

    //     Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    //     Route::get('/logout', [CustomerAuthController::class, 'logout'])->name('logout');

    //     Route::get('/deposit', [DepositController::class, 'showForm'])->name('deposit.form');
    //     Route::post('/deposit', [DepositController::class, 'deposit'])->name('deposit.deposit');

    //     Route::get('/withdraw', [WithdrawController::class, 'showForm'])->name('withdraw.form');
    //     Route::post('/withdraw', [WithdrawController::class, 'withdraw'])->name('withdraw.withdraw');

    //     Route::get('/transfer', [P2PTransferController::class, 'showForm'])->name('transfer.form');
    //     Route::post('/transfer', [P2PTransferController::class, 'p2pTransfer'])->name('transfer.transfer');

    //     Route::get('/wallet/nonce', [CustomerAuthController::class, 'generateNonce'])->name('wallet.nonce');
    //     Route::post('/wallet/verify-ownership', [CustomerAuthController::class, 'verifyWalletOwnership'])->name('wallet.verify');

    //     Route::get('/topup', [Topup9PayController::class, 'showForm'])->name('topup.form');
    //     Route::post('/topup', [Topup9PayController::class, 'topup'])->name('topup.topup');
    // });
