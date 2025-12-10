<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Services\DepositService;
use App\Services\Payment\NinePayService;
use App\Services\LevelIncomeService;

use App\Models\FreeDepositPackagesModel;
use App\Models\CustomersModel;

use App\Traits\ManagesCustomerFinancials;

class DepositController extends Controller
{
    protected $depositService;
    protected $ninePay;
    protected $levelIncomeServices;

    use ManagesCustomerFinancials;

    public function __construct(DepositService $depositService, NinePayService $ninePay, LevelIncomeService $levelIncomeService)
    {
        $this->depositService = $depositService;
        $this->ninePay = $ninePay;
        $this->levelIncomeServices = $levelIncomeService;
    }

    public function showForm()
    {
        $customer = Auth::guard('customer')->user();
        $finance = $this->getCustomerFinance($customer->id, $customer->app_id);
        $topup_amount = $finance->total_topup;
        return view('customer.deposit.form', compact('topup_amount'));
    }

    public function deposit(Request $request)
    {
        // dd($request->all());
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'package_id' => 'required|exists:app_packages,id',
            'amount'     => 'required|numeric',
            // 'txn_id'     => 'required|string|unique:customer_deposits,transaction_id',
        ]);

        try 
        {
            
            // 1️⃣ Validate internal rules
            $package = $this->depositService
                            ->validateDepositRules($customer, $validated['package_id'], $validated['amount']);
            
            // 2️⃣ Initiate 9Pay transaction. Here init_ninepay = transaction id
            $freepackages = FreeDepositPackagesModel::where('status',1)
                                        ->where('app_id',$customer->app_id)
                                        ->where('customer_id',$customer->id)
                                        ->where('package_id', $validated['package_id'])
                                        ->first();
            // dd($freepackages);
            $deposit = '';
            $txnId = "DEPOSIT-".Str::random(8);
            if($freepackages)
            {
                $txnId = "DEPOSITFREEPACKAGE-".$freepackages->id; //DUMMY TXN ID
            }

            // 3️⃣ Create deposit
            $deposit = $this->depositService->createPendingDeposit($customer, $package, $validated['amount'], $txnId);
            
            // 4️⃣ Mark deposit successful
            $deposit = $this->depositService->markDepositSuccess($deposit);
            
            $sponsor = CustomersModel::find($customer->sponsor_id);
            $this->levelIncomeServices->releaseLevelIncome($sponsor, $deposit);

            return redirect()
                    ->route('customer.deposit.form')
                    ->with('success', 'Deposit successfully!');

        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

}
