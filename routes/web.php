<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

use App\Http\Controllers\superadmin\SuperAdminAuthController;
use App\Http\Controllers\superadmin\SuperAdminController;
use App\Http\Controllers\superadmin\AppsController;
use App\Http\Controllers\superadmin\AdminController as SuperadminAsAdmin;

use App\Http\Controllers\customer\CustomerAuthController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\customer\DepositController;
use App\Http\Controllers\customer\WithdrawController;
use App\Http\Controllers\customer\P2PTransferController;
use App\Http\Controllers\Customer\Topup9PayController;

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AppPackagesController;
use App\Http\Controllers\admin\AppLevelPackagesController;
use App\Http\Controllers\admin\AppCustomersController;
use App\Http\Controllers\admin\AppFreeDepositPackagesController;

use App\Http\Controllers\TestController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/test-qr', [TestController::class, 'show'])->name('testqr');

// Route::middleware(['auth:superadmin', 'auth.superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
Route::prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/login', [SuperAdminAuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [SuperAdminAuthController::class, 'login']);
    Route::get('/logout', [SuperAdminAuthController::class, 'logout'])->name('logout');
    Route::middleware(['auth:superadmin', 'auth.superadmin'])->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('apps', AppsController::class);
        // GET /superadmin/apps
        // GET /superadmin/apps/create
        // POST /superadmin/apps
        // GET /superadmin/apps/{app}/edit
        // PUT /superadmin/apps/{app}
        // DELETE /superadmin/apps/{app}

        Route::resource('admins', SuperadminAsAdmin::class)->except(['show']);
        // GET	/superadmin/admins	
        // GET	/superadmin/admins/create
        // POST /superadmin/admins	
        // GET	/superadmin/admins/{admin}/edit
        // PUT/PATCH /superadmin/admins/{admin}

        // Login-as Admin
        Route::get('/admins/{admin}/login-as', [AdminController::class, 'loginAs'])->name('admins.loginAs');
    });
});

// Route::middleware(['auth:admin', 'auth.admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

//     // Logout
//     Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
// });

Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Login Routes (No Auth Middleware applied here)
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.login');
    
    // Protected Admin Routes (Requires admin authentication)
    Route::middleware(['auth:admin', 'auth.admin'])->group(function () {
        
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

        // Resourceful Routes for Management
        // Use standard Laravel resource controllers for managing items
        Route::resource('packages', AppPackagesController::class);
        // GET /admin/packages
        // GET /admin/packages/create
        // POST /admin/packages
        // GET /admin/packages/{app}/edit
        // PUT /admin/packages/{app}
        // DELETE /admin/packages/{app}

        Route::resource('levelpackages', AppLevelPackagesController::class);
        // GET /admin/levelpackages
        // GET /admin/levelpackages/create
        // POST /admin/levelpackages
        // GET /admin/levelpackages/{app}/edit
        // PUT /admin/levelpackages/{app}
        // DELETE /admin/levelpackages/{app}

        Route::resource('appcustomers', AppCustomersController::class);
        // GET /admin/appcustomers
        // GET /admin/appcustomers/create
        // POST /admin/appcustomers
        // GET /admin/appcustomers/{app}/edit
        // PUT /admin/appcustomers/{app}
        // DELETE /admin/appcustomers/{app}

        Route::resource('freedepositpackages', AppFreeDepositPackagesController::class);
        // GET /admin/freedepositpackages
        // GET /admin/freedepositpackages/create
        // POST /admin/freedepositpackages
        // GET /admin/freedepositpackages/{app}/edit
        // PUT /admin/freedepositpackages/{app}
        // DELETE /admin/freedepositpackages/{app}

        // Specific Action: Login as Customer
        Route::get('/login-as-customer/{customerId}', [AdminController::class, 'loginAsCustomer'])->name('login.as.customer');

    });
});


Route::prefix('customer')->name('customer.')->group(function () {

    // Registration
    Route::get('/register/{sponsorcode?}', [CustomerAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [CustomerAuthController::class, 'register'])->name('register.submit');

    // Login
    Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'login'])->name('login.submit');
    
    Route::get('/web3login', [CustomerAuthController::class, 'web3Login'])->name('web3login');

    // Protected dashboard
    Route::middleware(['auth:customer'])->group(function () {
        // Route::get('/web3login', [CustomerAuthController::class, 'web3Login'])->name('web3login');

        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [CustomerAuthController::class, 'logout'])->name('logout');

        Route::get('/deposit', [DepositController::class, 'showForm'])->name('deposit.form');
        Route::post('/deposit', [DepositController::class, 'deposit'])->name('deposit.deposit');

        Route::get('/withdraw', [WithdrawController::class, 'showForm'])->name('withdraw.form');
        Route::post('/withdraw', [WithdrawController::class, 'withdraw'])->name('withdraw.withdraw');

        Route::get('/transfer', [P2PTransferController::class, 'showForm'])->name('transfer.form');
        Route::post('/transfer', [P2PTransferController::class, 'p2pTransfer'])->name('transfer.transfer');

        Route::get('/wallet/nonce', [CustomerAuthController::class, 'generateNonce'])->name('wallet.nonce');
        Route::post('/wallet/verify-ownership', [CustomerAuthController::class, 'verifyWalletOwnership'])->name('wallet.verify');

        Route::get('/topup', [Topup9PayController::class, 'showForm'])->name('topup.form');
        Route::post('/topup', [Topup9PayController::class, 'topup'])->name('topup.topup');
    });
});