<?php

namespace App\Http\Controllers;

use App\Models\Claim;
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
    public function loadModal($id, $action)
    {
        $claim = $action === 'active' ? Claim::findOrFail($id)->first() : Claim::withTrashed()->where('id', $id)->first();
        if ($claim->prepayment) {
            $prepayment = FinancePrepayment::findOrFail($claim->prepayment->id);
            return view('claim.finance.modals.prepayment_update', compact('prepayment'))->render();
        } else {
            return view('claim.finance.modals.prepayment_create')->render();
        }
    }
}
