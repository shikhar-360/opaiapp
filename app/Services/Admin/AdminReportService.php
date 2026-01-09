<?php
// app/Services/Email/EmailService.php
namespace App\Services\Admin;

use App\Models\CustomersModel;
use App\Models\CustomerSettingsModel;
use App\Models\CustomerDepositsModel;
use App\Models\CustomerEarningDetailsModel;
use App\Models\CustomerWithdrawsModel;

class AdminReportService
{
    public function dashboardSummary(): array
    {
        return [
            'total_customers' => $this->totalCustomers(),
            'active_customers' => $this->activeCustomers(),
            'total_deposits' => $this->totalDeposits(),
            'total_deposit_amount' => $this->totalDepositAmount(),
            'total_withdraw_amount' => $this->totalWithdrawAmount(),
            'total_usdt' => $this->totalUSDT(),
        ];
    }

    public function totalCustomers(): int
    {
        return CustomersModel::count();
    }

    public function activeCustomers(): int
    {
        return CustomersModel::where('status', 1)->count();
    }

    public function totalDeposits(): int
    {
        return CustomerDepositsModel::where('payment_status', 'success')->count();
    }

    public function totalDepositAmount(): float
    {
        return (float) CustomerDepositsModel::where('payment_status', 'success')
            ->sum('amount');
    }

    public function totalWithdrawAmount(): float
    {
        return (float) CustomerWithdrawsModel::where('transaction_status', 'success')
            ->sum('amount');
    }

    public function totalUSDT(): float
    {
        return (float) DB::table('customer_wallets')->sum('usdt_balance');
    }

    /**
        * Export data as CSV.
        *
        * @param array|\Illuminate\Support\Collection $data
        * @param array $columns  // ['Column Header' => 'key_in_data']
        * @param string $filename
        * @return \Illuminate\Http\Response
    */
    public function exportCsv($data, array $columns, string $filename)
    {
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}.csv",
        ];

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');

            // Add header row
            fputcsv($file, array_keys($columns));

            // Add data rows
            foreach ($data as $row) {
                $csvRow = [];
                foreach ($columns as $key) {
                    // Support objects and arrays
                    if (is_array($row)) {
                        $csvRow[] = $row[$key] ?? '';
                    } elseif (is_object($row)) {
                        $csvRow[] = $row->{$key} ?? '';
                    }
                }
                fputcsv($file, $csvRow);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function depositDetails($from, $to, $search)
    {
        return CustomerDepositsModel::query()
                                        ->join('customers as c', 'c.id', '=', 'customer_deposits.customer_id')
                                        ->leftJoin('customer_settings as cs', 'cs.customer_id', '=', 'c.id')
                                        ->leftJoin('customer_financials as cf', 'cf.customer_id', '=', 'c.id')
                                        // ->where('customer_deposits.payment_status', 'success')
                                        ->whereBetween('customer_deposits.created_at', [$from, $to])
                                        // 🔍 SEARCH FILTER
                                        ->when(!empty($search), function ($query) use ($search) {
                                            $query->where(function ($q) use ($search) {
                                                $q->where('customer_deposits.amount', 'like', "%{$search}%")
                                                ->orWhere('c.name', 'like', "%{$search}%")
                                                ->orWhere('c.referral_code', 'like', "%{$search}%")
                                                ->orWhere('c.wallet_address', 'like', "%{$search}%");
                                            });
                                        })
                                        ->select([
                                            'customer_deposits.id',
                                            'customer_deposits.package_id',
                                            'customer_deposits.amount',
                                            'customer_deposits.is_free_deposit',
                                            'customer_deposits.created_at',
                                            'customer_deposits.payment_status',

                                            'c.name',
                                            'c.referral_code',
                                            'c.wallet_address',

                                            'cs.*',
                                            'cf.*'
                                        ])
                                        ->orderBy('customer_deposits.created_at', 'desc')
                                        ->get();
    }

    public function earningDetails($from, $to, $search)
    {
        return CustomerEarningDetailsModel::query()
                                        ->join('customers as c', 'c.id', '=', 'customer_earning_details.customer_id')
                                        ->leftJoin('customer_settings as cs', 'cs.customer_id', '=', 'c.id')
                                        ->leftJoin('customer_financials as cf', 'cf.customer_id', '=', 'c.id')
                                        // ->where('customer_deposits.payment_status', 'success')
                                        ->whereBetween('customer_earning_details.created_at', [$from, $to])
                                        // 🔍 SEARCH FILTER
                                        ->when(!empty($search), function ($query) use ($search) {
                                            $query->where(function ($q) use ($search) {
                                                $q->where('customer_earning_details.amount_earned', 'like', "%{$search}%")
                                                ->orWhere('c.name', 'like', "%{$search}%")
                                                ->orWhere('c.referral_code', 'like', "%{$search}%")
                                                ->orWhere('c.wallet_address', 'like', "%{$search}%");
                                            });
                                        })
                                        ->select([
                                            'customer_earning_details.id',
                                            'customer_earning_details.reference_id',
                                            'customer_earning_details.reference_amount',
                                            'customer_earning_details.reference_level',
                                            'customer_earning_details.amount_earned',
                                            'customer_earning_details.flush_amount',
                                            'customer_earning_details.earning_type',
                                            'customer_earning_details.created_at',

                                            'c.name',
                                            'c.referral_code',
                                            'c.wallet_address',

                                            'cs.*',
                                            'cf.*'
                                        ])
                                        ->orderBy('customer_earning_details.created_at', 'desc')
                                        ->get();
    }

    public function withdrawDetails($from, $to, $search)
    {
        return CustomerWithdrawsModel::query()
                                        ->join('customers as c', 'c.id', '=', 'customer_withdraws.customer_id')
                                        ->leftJoin('customer_settings as cs', 'cs.customer_id', '=', 'c.id')
                                        ->leftJoin('customer_financials as cf', 'cf.customer_id', '=', 'c.id')
                                        ->where('customer_withdraws.transaction_type', 'withdraw')
                                        ->whereBetween('customer_withdraws.created_at', [$from, $to])
                                        // 🔍 SEARCH FILTER
                                        ->when(!empty($search), function ($query) use ($search) {
                                            $query->where(function ($q) use ($search) {
                                                $q->where('customer_withdraws.amount', 'like', "%{$search}%")
                                                ->orWhere('c.name', 'like', "%{$search}%")
                                                ->orWhere('c.referral_code', 'like', "%{$search}%")
                                                ->orWhere('c.wallet_address', 'like', "%{$search}%")
                                                ->orWhere('customer_withdraws.transaction_id', 'like', "%{$search}%")
                                                ->orWhere('customer_withdraws.transaction_status', 'like', "%{$search}%");
                                            });
                                        })
                                        ->select([
                                            'customer_withdraws.id',
                                            'customer_withdraws.admin_charge',
                                            'customer_withdraws.amount',
                                            'customer_withdraws.net_amount',
                                            // 'customer_withdraws.to_customer',
                                            'customer_withdraws.transaction_type',
                                            'customer_withdraws.transaction_id',
                                            'customer_withdraws.transaction_status',
                                            'customer_withdraws.created_at',
                                            
                                            'c.name',
                                            'c.referral_code',
                                            'c.wallet_address',

                                            'cs.*',
                                            'cf.*'
                                        ])
                                        ->orderBy('customer_withdraws.created_at', 'desc')
                                        ->get();
    }

    public function withdrawP2PDetails($from, $to, $search)
    {
        return CustomerWithdrawsModel::query()
                                        ->join('customers as c', 'c.id', '=', 'customer_withdraws.customer_id')
                                        ->leftJoin('customers as tc', 'tc.id', '=', 'customer_withdraws.to_customer')
                                        ->leftJoin('customer_settings as cs', 'cs.customer_id', '=', 'c.id')
                                        ->leftJoin('customer_financials as cf', 'cf.customer_id', '=', 'c.id')
                                        ->where('customer_withdraws.transaction_type', 'p2ptransfer')
                                        ->whereBetween('customer_withdraws.created_at', [$from, $to])
                                        // 🔍 SEARCH FILTER
                                        ->when(!empty($search), function ($query) use ($search) {
                                            $query->where(function ($q) use ($search) {
                                                $q->where('customer_withdraws.amount', 'like', "%{$search}%")
                                                ->orWhere('c.name', 'like', "%{$search}%")
                                                 ->orWhere('tc.name', 'like', "%{$search}%")
                                                ->orWhere('c.referral_code', 'like', "%{$search}%")
                                                ->orWhere('c.wallet_address', 'like', "%{$search}%")
                                                ->orWhere('customer_withdraws.transaction_id', 'like', "%{$search}%")
                                                ->orWhere('customer_withdraws.transaction_status', 'like', "%{$search}%");
                                            });
                                        })
                                        ->select([
                                            'customer_withdraws.id',
                                            'customer_withdraws.admin_charge',
                                            'customer_withdraws.amount',
                                            'customer_withdraws.net_amount',
                                            'customer_withdraws.to_customer',
                                            'customer_withdraws.transaction_type',
                                            'customer_withdraws.transaction_id',
                                            'customer_withdraws.transaction_status',
                                            'customer_withdraws.created_at',
                                            
                                            'c.name',
                                            'c.referral_code',
                                            'c.wallet_address',
                                            
                                            'tc.name as to_customer_name',

                                            'cs.*',
                                            'cf.*'
                                        ])
                                        ->orderBy('customer_withdraws.created_at', 'desc')
                                        ->get();
    }

    public function withdrawSelfDetails($from, $to, $search)
    {
        return CustomerWithdrawsModel::query()
                                        ->join('customers as c', 'c.id', '=', 'customer_withdraws.customer_id')
                                        ->leftJoin('customer_settings as cs', 'cs.customer_id', '=', 'c.id')
                                        ->leftJoin('customer_financials as cf', 'cf.customer_id', '=', 'c.id')
                                        ->where('customer_withdraws.transaction_type', 'selftranfer')
                                        ->whereBetween('customer_withdraws.created_at', [$from, $to])
                                        // 🔍 SEARCH FILTER
                                        ->when(!empty($search), function ($query) use ($search) {
                                            $query->where(function ($q) use ($search) {
                                                $q->where('customer_withdraws.amount', 'like', "%{$search}%")
                                                ->orWhere('c.name', 'like', "%{$search}%")
                                                ->orWhere('c.referral_code', 'like', "%{$search}%")
                                                ->orWhere('c.wallet_address', 'like', "%{$search}%")
                                                ->orWhere('customer_withdraws.transaction_id', 'like', "%{$search}%")
                                                ->orWhere('customer_withdraws.transaction_status', 'like', "%{$search}%");
                                            });
                                        })
                                        ->select([
                                            'customer_withdraws.id',
                                            'customer_withdraws.admin_charge',
                                            'customer_withdraws.amount',
                                            'customer_withdraws.net_amount',
                                            // 'customer_withdraws.to_customer',
                                            'customer_withdraws.transaction_type',
                                            'customer_withdraws.transaction_id',
                                            'customer_withdraws.transaction_status',
                                            'customer_withdraws.created_at',
                                            
                                            'c.name',
                                            'c.referral_code',
                                            'c.wallet_address',

                                            'cs.*',
                                            'cf.*'
                                        ])
                                        ->orderBy('customer_withdraws.created_at', 'desc')
                                        ->get();
    }
}
