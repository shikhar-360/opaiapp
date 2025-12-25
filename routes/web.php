<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\customer\CustomerAuthController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\customer\DepositController;
use App\Http\Controllers\customer\WithdrawController;
use App\Http\Controllers\customer\P2PTransferController;
use App\Http\Controllers\customer\Topup9PayController;
use App\Http\Controllers\customer\OverviewController;
use App\Http\Controllers\customer\SupportTicketsController;

use App\Http\Controllers\superadmin\SuperAdminAuthController;
use App\Http\Controllers\superadmin\SuperAdminController;
use App\Http\Controllers\superadmin\AppsController;
use App\Http\Controllers\superadmin\AdminController as SuperadminAsAdmin;

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AppPackagesController;
use App\Http\Controllers\admin\AppLevelPackagesController;
use App\Http\Controllers\admin\AppCustomersController;
use App\Http\Controllers\admin\AppFreeDepositPackagesController;
use App\Http\Controllers\admin\AppLeadershipPackagesController;

Route::get('/', [CustomerAuthController::class, 'showLoginForm'])->name('login');

// Registration
Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('register');
// Route::get('/register/{sponsorcode?}', [CustomerAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [CustomerAuthController::class, 'register'])->name('register.submit');

Route::get('/forgot', [CustomerAuthController::class, 'showForgotPassword'])->name('forgot');
Route::post('/forgot', [CustomerAuthController::class, 'forgot'])->name('forgot.submit');

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
    Route::post('/pay-qr/transaction', [Topup9PayController::class, 'topupCancel'])->name('pay.qr.cancel');

    Route::get('/pay-topup', [DepositController::class, 'showForm'])->name('pay.topup');
    Route::post('/pay-topup', [DepositController::class, 'deposit'])->name('pay.topup.save');
   
    Route::get('/withdraw', [WithdrawController::class, 'showForm'])->name('withdraw');
    Route::post('/withdraw', [WithdrawController::class, 'withdraw'])->name('withdraw.save');   

    Route::get('/overview', [OverviewController::class, 'incomeOverview'])->name('overview');
    Route::post('/overview', [OverviewController::class, 'incomeOverview'])->name('overview.filter');

    Route::get('/tickets', [SupportTicketsController::class, 'showForm'])->name('tickets');
    Route::post('/tickets', [SupportTicketsController::class, 'saveTickets'])->name('tickets.save');

    Route::post('/vote', [CustomerController::class, 'saveVote'])->name('customer.vote.save');

    Route::get('/promotion', [CustomerController::class, 'showPromotion'])->name('promotion');
});




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

        Route::resource('leadershippackages', AppLeadershipPackagesController::class);
        // GET /admin/leadershippackages
        // GET /admin/leadershippackages/create
        // POST /admin/leadershippackages
        // GET /admin/leadershippackages/{app}/edit
        // PUT /admin/leadershippackages/{app}
        // DELETE /admin/leadershippackages/{app}

        // Specific Action: Login as Customer
        Route::get('/login-as-customer/{customerId}', [AdminController::class, 'loginAsCustomer'])->name('login.as.customer');

    });
});