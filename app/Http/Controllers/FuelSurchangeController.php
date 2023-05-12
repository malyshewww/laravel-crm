<?php

namespace App\Http\Controllers;

use App\Models\FuelSurchange;
use Illuminate\Http\Request;

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
            'id'  => $request->fuelsurchange_id,
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
