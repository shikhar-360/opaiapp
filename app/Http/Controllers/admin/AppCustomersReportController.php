<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

use App\Models\CustomersModel;

use App\Services\Admin\AdminReportService;

class AppCustomersReportController extends Controller
{
    
    protected $adminReportService;

    public function __construct(AdminReportService $admin_report_service)
    {
        $this->adminReportService = $admin_report_service;
    }
    
    public function depositDetails(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // Default dates
        $from   = now()->subDays(30)->format('Y-m-d');
        $to     = now()->format('Y-m-d');
        $search = '';

        // Validate only when form is submitted
        if ($request->isMethod('post')) {
            // dd($request->all());
            $validated = $request->validate([
                'from'   =>  'required|date',
                'to'     =>  'required|date|after_or_equal:from',
                'search' =>  'nullable'
            ]);

            $from           =   $validated['from'];
            $to             =   $validated['to'];
            $search         =   $validated['search'];
        }

        // Get data once
        $deposit_details = $this->adminReportService->depositDetails($from, $to, $search);

        // DOWNLOAD MODE
        if ($request->input('isDownload') == 1) {

            $deposit_details = $deposit_details->map(function ($row) {
                return [
                    'customer_name' =>    $row->name,
                    'referral_code' =>    $row->referral_code,
                    'package_id'    =>    match ($row->package_id)   {
                                                        5 => 'Free',
                                                        4 => 'OP50',
                                                        3 => 'OP25',
                                                        2 => 'OP10',
                                                        1 => 'OP5',
                                                        default => '-',
                                                    },
                    'amount'          => $row->amount,
                    'status'          => ucfirst($row->payment_status),
                    'created_at'      => optional($row->created_at)
                                            ->format('d-m-Y'),
                    'is_free_deposit' => $row->is_free_deposit == 0 ? 'Paid' : 'Free',
                ];
            });
            
            $columns = [
                'Customer Name'  => 'customer_name',
                'Referral Code'  => 'referral_code',
                'Package'        => 'package_id',
                'Amount'         => 'amount',
                'Payment Status' => 'status',
                'Date'           => 'created_at',
                'Free'           => 'is_free_deposit',
            ];

            $filename = "deposits_{$from}_to_{$to}";

            return $this->adminReportService->exportCsv($deposit_details, $columns, $filename);
        }

        // NORMAL VIEW MODE
        return view(
            'admins.customers.reports.deposits',
            compact('deposit_details', 'from', 'to', 'search')
        );
    }

    public function earningDetails(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // Default dates
        $from   = now()->subDays(30)->format('Y-m-d');
        $to     = now()->format('Y-m-d');
        $search = '';

        // Validate only when form is submitted
        if ($request->isMethod('post')) {
            // dd($request->all());
            $validated = $request->validate([
                'from'      =>  'required|date',
                'to'        =>  'required|date|after_or_equal:from',
                'search'    =>  'nullable'
            ]);

            $from           =   $validated['from'];
            $to             =   $validated['to'];
            $search         =   $validated['search'];
        }

        // Get data once
        $earning_details = $this->adminReportService->earningDetails($from, $to, $search);

        // DOWNLOAD MODE
        if ($request->input('isDownload') == 1) {

            $earning_details = $earning_details->map(function ($row) {
                return [
                    'customer_name'     =>  $row->name,
                    'referral_code'     =>  $row->referral_code,
                    'reference_id'      =>  $row->reference_id,
                    'reference_amount'  =>  $row->reference_amount,
                    'reference_level'   =>  'C'.$row->reference_level,
                    'amount'            =>  $row->amount_earned,
                    'flush_amount'      =>  $row->flush_amount,
                    'earning_type'      =>  $row->earning_type,
                    'status'            =>  ucfirst($row->payment_status),
                    'created_at'        =>  optional($row->created_at)->format('d-m-Y'),
                    
                ];
            });
            
            $columns = [
                'Customer Name'  => 'customer_name',
                'Referral Code'  => 'referral_code',
                'Ref Customer'   => 'reference_id',
                'Ref Level'      => 'reference_level',
                'Amount'         => 'amount',
                'Flush Amount'   => 'flush_amount',
                'Type'           => 'earning_type',
                'Date'           => 'created_at'
            ];

            $filename = "earnings_{$from}_to_{$to}";

            return $this->adminReportService->exportCsv($earning_details, $columns, $filename);
        }

        // NORMAL VIEW MODE
        return view(
            'admins.customers.reports.earnings',
            compact('earning_details', 'from', 'to', 'search')
        );
    }

    public function withdrawDetails(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // Default dates
        $from   = now()->subDays(30)->format('Y-m-d');
        $to     = now()->format('Y-m-d');
        $search = '';

        // Validate only when form is submitted
        if ($request->isMethod('post')) {
            // dd($request->all());
            $validated = $request->validate([
                'from'      =>  'required|date',
                'to'        =>  'required|date|after_or_equal:from',
                'search'    =>  'nullable'
            ]);

            $from           =   $validated['from'];
            $to             =   $validated['to'];
            $search         =   $validated['search'];
        }

        // Get data once
        $withdraw_details = $this->adminReportService->withdrawDetails($from, $to, $search);

        // DOWNLOAD MODE
        if ($request->input('isDownload') == 1) {

            $withdraw_details = $withdraw_details->map(function ($row) {
                return [
                    'customer_name'     =>  $row->name,
                    'referral_code'     =>  $row->referral_code,
                    
                    'admin_charge'      =>  $row->admin_charge,
                    'amount'            =>  $row->amount,
                    'net_amount'        =>  $row->net_amount,
                    // 'to_customer'       =>  $row->to_customer,
                    'transaction_type'  =>  $row->transaction_type,
                    'transaction_id'    =>  $row->transaction_id,
                    'status'            =>  $row->transaction_status,
                    'created_at'        =>  $row->created_at,                    
                ];
            });
            
            $columns = [
                'Customer Name'     =>  'customer_name',
                'Referral Code'     =>  'referral_code',
                'Amount'            =>  'amount',
                'Admin Charge'      =>  'admin_charge',
                'Net Amount'        =>  'net_amount',
                // 'To Customer'       =>  'to_customer',
                'Txn Type'          =>  'transaction_type',
                'Txn ID'            =>  'transaction_id',
                'status'            =>  'status',
                'Date'              =>  'created_at'
            ];

            $filename = "withdraws_{$from}_to_{$to}";

            return $this->adminReportService->exportCsv($withdraw_details, $columns, $filename);
        }

        // NORMAL VIEW MODE
        return view(
            'admins.customers.reports.withdraws',
            compact('withdraw_details', 'from', 'to', 'search')
        );
    }

    public function p2pTransferDetails(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // Default dates
        $from   = now()->subDays(30)->format('Y-m-d');
        $to     = now()->format('Y-m-d');
        $search = '';

        // Validate only when form is submitted
        if ($request->isMethod('post')) {
            // dd($request->all());
            $validated = $request->validate([
                'from'      =>  'required|date',
                'to'        =>  'required|date|after_or_equal:from',
                'search'    =>  'nullable'
            ]);

            $from           =   $validated['from'];
            $to             =   $validated['to'];
            $search         =   $validated['search'];
        }

        // Get data once
        $p2ptransfer_details = $this->adminReportService->withdrawP2PDetails($from, $to, $search);

        // DOWNLOAD MODE
        if ($request->input('isDownload') == 1) {

            $p2p_details = $p2p_details->map(function ($row) {
                return [
                    'customer_name'     =>  $row->name,
                    'referral_code'     =>  $row->referral_code,
                    
                    'admin_charge'      =>  $row->admin_charge,
                    'amount'            =>  $row->amount,
                    'net_amount'        =>  $row->net_amount,
                    'to_customer'       =>  $row->to_customer,
                    'transaction_type'  =>  $row->transaction_type,
                    'transaction_id'    =>  $row->transaction_id,
                    'status'            =>  $row->transaction_status,
                    'created_at'        =>  $row->created_at,                    
                ];
            });
            
            $columns = [
                'Customer Name'     =>  'customer_name',
                'Referral Code'     =>  'referral_code',
                'Amount'            =>  'amount',
                'Admin Charge'      =>  'admin_charge',
                'Net Amount'        =>  'net_amount',
                'To Customer'       =>  'to_customer',
                'Txn Type'          =>  'transaction_type',
                'Txn ID'            =>  'transaction_id',
                'status'            =>  'status',
                'Date'              =>  'created_at'
            ];

            $filename = "p2ptransfers_{$from}_to_{$to}";

            return $this->adminReportService->exportCsv($p2ptransfer_details, $columns, $filename);
        }

        // NORMAL VIEW MODE
        return view(
            'admins.customers.reports.p2ptransfers',
            compact('p2ptransfer_details', 'from', 'to', 'search')
        );
    }

    public function selfTransferDetails(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // Default dates
        $from   = now()->subDays(30)->format('Y-m-d');
        $to     = now()->format('Y-m-d');
        $search = '';

        // Validate only when form is submitted
        if ($request->isMethod('post')) {
            // dd($request->all());
            $validated = $request->validate([
                'from'      =>  'required|date',
                'to'        =>  'required|date|after_or_equal:from',
                'search'    =>  'nullable'
            ]);

            $from           =   $validated['from'];
            $to             =   $validated['to'];
            $search         =   $validated['search'];
        }

        // Get data once
        $selftransfer_details = $this->adminReportService->withdrawSelfDetails($from, $to, $search);

        // DOWNLOAD MODE
        if ($request->input('isDownload') == 1) {

            $p2p_details = $p2p_details->map(function ($row) {
                return [
                    'customer_name'     =>  $row->name,
                    'referral_code'     =>  $row->referral_code,
                    
                    'admin_charge'      =>  $row->admin_charge,
                    'amount'            =>  $row->amount,
                    'net_amount'        =>  $row->net_amount,
                    'transaction_type'  =>  $row->transaction_type,
                    'transaction_id'    =>  $row->transaction_id,
                    'status'            =>  $row->transaction_status,
                    'created_at'        =>  $row->created_at,                    
                ];
            });
            
            $columns = [
                'Customer Name'     =>  'customer_name',
                'Referral Code'     =>  'referral_code',
                'Amount'            =>  'amount',
                'Admin Charge'      =>  'admin_charge',
                'Net Amount'        =>  'net_amount',
                'Txn Type'          =>  'transaction_type',
                'Txn ID'            =>  'transaction_id',
                'status'            =>  'status',
                'Date'              =>  'created_at'
            ];

            $filename = "selftransfer_{$from}_to_{$to}";

            return $this->adminReportService->exportCsv($selftransfer_details, $columns, $filename);
        }

        // NORMAL VIEW MODE
        return view(
            'admins.customers.reports.selftransfers',
            compact('selftransfer_details', 'from', 'to', 'search')
        );
    }
}
