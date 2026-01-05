<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\PromotionThounsandService;
use App\Services\LevelIncomeService;

class TestController extends Controller
{
    protected $pk;
    protected $lis;

    public function __construct(PromotionThounsandService $p1000, LevelIncomeService $liss)
    {
        $this->pk = $p1000;
        $this->lis = $liss;
    }

    public function testPromotionThounsand(Request $request)
    {
        // $this->pk->assignPromotionThousand($promotion_pkg=1);
        // $this->pk->assignPromotionFiveHundred($promotion_pkg=2);
        // $this->pk->assignPromotionTenX($promotion_pkg=3);
        // $this->pk->assignPromotionFiveThousand($promotion_pkg=4);
    }

    public function testLevelIncome(Request $request)
    {
        $deposit = [
            'app_id'        => 1,
            'customer_id'   => 13,
            'package_id'    => 2,
            'amount'        => 10,
            'roi_percent'   => 0,
            'transaction_id'=> 'abcd123',
            'payment_status'=> 'pending',
            'coin_price'    => 2
        ];

        $lis_res = $this->lis->generateLevelIncome($deposit);

        dd($lis_res);
    }
}
