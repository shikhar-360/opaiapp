<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Services\DepositService;
use App\Services\Payment\NinePayService;

use App\Models\FreeDepositPackagesModel;

class DepositController extends Controller
{
    protected $depositService;
    protected $ninePay;

    public function __construct(DepositService $depositService, NinePayService $ninePay)
    {
        $this->depositService = $depositService;
        $this->ninePay = $ninePay;
    }

    public function showForm()
    {
        return view('customer.deposit.form');
    }

    public function deposit(Request $request)
    {
        
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'package_id' => 'required|exists:app_packages,id',
            'amount'     => 'required|numeric',
            // 'txn_id'     => 'required|string|unique:customer_deposits,transaction_id',
        ]);

        try {
            
            // 1️⃣ Validate internal rules
            $package = $this->depositService
                            ->validateDepositRules($customer, $validated['package_id'], $validated['amount']);

            // 2️⃣ Initiate 9Pay transaction. Here init_ninepay = transaction id
            $freepackages = FreeDepositPackagesModel::where('status',1)
                                        ->where('app_id',$customer->app_id)
                                        ->where('customer_id',$customer->id)
                                        ->where('package_id', $validated['package_id'])
                                        ->first();
            
            $init_ninepay = '';
            if(!$freepackages)
            {
                $init_ninepay = $this->ninePay->initiateTransaction($customer, $package, $validated['amount']);
            }
            else
            {
                $init_ninepay = "FREEPACKAGE-".$freepackages->id; //DUMMY TXN ID
            }

            // 3️⃣ Create deposit
            $deposit = $this->depositService
                            ->createPendingDeposit($customer, $package, $validated['amount'], $init_ninepay);
            
            // 4️⃣ Mark deposit successful
            $deposit = $this->depositService->markDepositSuccess($deposit);

            return redirect()
                    ->route('customer.deposit.form')
                    ->with('success', 'Deposit successfully!');

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

}
