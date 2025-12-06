<?php

namespace App\Http\Controllers;

use App\Services\QRCodeService;
use Illuminate\Routing\Controller; // Ensure Controller is imported

class TestController extends Controller
{
    protected $qrs;

    public function __construct(QRCodeService $qr)
    {
        $this->qrs = $qr;
    }

    public function testApp(Request $request)
    {
        return response()->json([
                                'status' => true,
                                'message' => 'Success',
                                'data' => $request->all()
                            ]);
    }


    public function show()
    {
        $rawImageData = $this->qrs->generate('Hello 9Pay!');
        $base64Uri = $rawImageData;
        return view('test.qr', compact('base64Uri'));
    }
}
