<?php

namespace App\Http\Controllers;

use App\Models\FinancePrepayment;
use Illuminate\Http\Request;

class FinancePrepaymentController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'percent' => $request->percent,
            'days' => $request->days,
            'claim_id' => $request->claim_id,
        ];
        FinancePrepayment::updateOrCreate([
            'claim_id' => $request->claim_id,
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
