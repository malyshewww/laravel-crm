<?php

namespace App\Http\Controllers;

use App\Models\Claim;
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
    public function loadModal($id, $action)
    {
        $claim = Claim::withTrashed()->where('id', $id)->first();
        if ($claim->payment) {
            $payment = FinancePayment::findOrFail($claim->payment->id);
            return view('claim.finance.modals.payment_update', compact('payment'))->render();
        } else {
            return view('claim.finance.modals.payment_create')->render();
        }
    }
}
