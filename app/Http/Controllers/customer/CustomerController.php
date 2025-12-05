<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function dasboard()
    {
        return view('customer.dashboard');
    }

    public function showDepositForm()
    {
        return view('customer.deposit');
    }
}
