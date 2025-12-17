<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\PromotionThounsandService;

class TestController extends Controller
{
    protected $pk;

    public function __construct(PromotionThounsandService $p1000)
    {
        $this->pk = $p1000;
    }

    public function testPromotionThounsand(Request $request)
    {
        $this->pk->assignPromotionThousand();

    }

    
}
