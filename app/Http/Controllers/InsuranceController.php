<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'type' => $request->type,
            'insurance_name' => $request->insurance_name,
            'insurance_company' => $request->insurance_company,
            'insurance_type' => $request->insurance_type,
            'insurance_type_other' => $request->insurance_type_other,
            'dateinsurance_start' => $request->dateinsurance_start,
            'dateinsurance_end' => $request->dateinsurance_end,
            'insurance_sum' => $request->insurance_sum,
            'claim_id' => $request->claim_id,
        ];
        Insurance::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function update(Request $request)
    {
        $data = [
            'type' => $request->type,
            'insurance_name' => $request->insurance_name,
            'insurance_company' => $request->insurance_company,
            'insurance_type' => $request->insurance_type,
            'insurance_type_other' => $request->insurance_type_other,
            'dateinsurance_start' => $request->dateinsurance_start,
            'dateinsurance_end' => $request->dateinsurance_end,
            'insurance_sum' => $request->insurance_sum,
            'claim_id' => $request->claim_id,
        ];
        Insurance::updateOrCreate([
            'id'  => $request->insurance_id,
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function destroy($id)
    {
        $insurance = Insurance::findOrFail($id);
        $insurance->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
}
