<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\WithdrawService;

class WithdrawController extends Controller
{
    protected $withdrawServices;

    public function __construct(WithdrawService $withdrawService)
    {
        $this->withdrawServices = $withdrawService;
    }

    public function showForm()
    {
        return view('customer.withdraw.form');
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.0000001',
        ]);

        $customer = Auth::guard('customer')->user();

        try {
            $withdraw = $this->withdrawServices->processWithdrawal($customer, $request->amount);

            return redirect()
                    ->route('customer.withdraw.form')
                    ->with('success', $withdraw);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
