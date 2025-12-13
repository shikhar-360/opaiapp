<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\Models\CustomerWithdrawsModel;
use App\Models\CustomerEarningDetailsModel;

use App\Services\WithdrawService;
use App\Services\DashboardMatriceService;

class OverviewController extends Controller
{
    protected $withdrawServices;
    protected $dashbaord_matrice_services;

    public function __construct(WithdrawService $withdrawService, DashboardMatriceService $dashbaord_matrice_service)
    {
        $this->withdrawServices = $withdrawService;
        $this->dashbaord_matrice_services = $dashbaord_matrice_service;
    }

    public function incomeOverview(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        
        $dateFrom = $request->filled('start_date')
        ? Carbon::parse($request->start_date)->startOfDay()
        : Carbon::now()->subDays(10)->startOfDay();

        $dateTo = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfDay();
        // dd($dateFrom, $dateTo);
        $dashboard_matrics                  =   $this->dashbaord_matrice_services->showDashboardMetrics($customer->id);
        $customer->myLevel                  =   $dashboard_matrics['myLevel'];
        $customer->myLevelEarning           =   $dashboard_matrics['myLevelEarning'];
        
        $levelIncomeDetails = CustomerEarningDetailsModel::where('customer_id', $customer->id)
                                                            ->where('app_id', $customer->app_id)
                                                            ->where('earning_type', 'LEVEL-REWARD')
                                                            ->whereBetween('created_at', [$dateFrom, $dateTo])
                                                            ->latest()
                                                            ->get();
        // dd($levelIncomeDetails);
        $customer->levelIncomeDetails   = $levelIncomeDetails;
        $customer->levelIncomeCount     = $levelIncomeDetails->count();
        $customer->levelIncomeDatefrom  = $dateFrom->format('Y-m-d');
        $customer->levelIncomeDateto    = $dateTo->format('Y-m-d');

        // dd($customer);
        
        return view('customer.overview', compact('customer'));
    }

    
}
