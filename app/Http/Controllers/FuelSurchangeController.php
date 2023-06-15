<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\FuelSurchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuelSurchangeController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'type' => $request->type,
            'fuelsurchange_name' => $request->fuelsurchange_name,
            'fuelsurchange_date_start' => $request->fuelsurchange_date_start,
            'fuelsurchange_date_end' => $request->fuelsurchange_date_end,
            'claim_id' => $request->claim_id,
        ];
        FuelSurchange::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function update(Request $request)
    {
        $data = [
            'type' => $request->type,
            'fuelsurchange_name' => $request->fuelsurchange_name,
            'fuelsurchange_date_start' => $request->fuelsurchange_date_start,
            'fuelsurchange_date_end' => $request->fuelsurchange_date_end,
            'claim_id' => $request->claim_id,
        ];
        FuelSurchange::updateOrCreate([
            'id'  => $request->record_id,
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function destroy($id)
    {
        $fuelSurchange = FuelSurchange::findOrFail($id);
        $fuelSurchange->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function loadModal($id, $claimId, $action)
    {
        $fs = FuelSurchange::findOrFail($id);
        $claim = Claim::find($claimId);
        return view('claim.services.modals.modal_update_fuelsurchange', compact('fs', 'claim'))->render();
    }
}
