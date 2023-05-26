<?php

namespace App\Http\Controllers;

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
    public function loadModal($id, $action)
    {
        $fs = FuelSurchange::findOrFail($id);
        $tourists = DB::table('tourists')
            ->join('claims', 'tourists.claim_id', '=', 'claims.id')
            ->select('tourists.*')
            ->get();
        return view('claim.services.modals.modal_update_fuelsurchange', compact('fs', 'tourists'))->render();
    }
}
