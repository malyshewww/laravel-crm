<?php

namespace App\Http\Controllers;

use App\Models\FinancePayment;
use Illuminate\Http\Request;

class FinancePaymentController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'currency' => $request->currency,
            'tourist_course' => $request->tourist_course,
            'tour_price' => $request->tour_price,
            'comission_price' => $request->comission_price,
            'claim_id' => $request->claim_id,
        ];
        FinancePayment::updateOrCreate([
            'claim_id' => $request->claim_id
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
