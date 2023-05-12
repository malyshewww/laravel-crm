<?php

namespace App\Http\Controllers;

use App\Models\Visa;
use Illuminate\Http\Request;

class VisaController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'type' => $request->type,
            'visa_name' => $request->visa_name,
            'visa_country' => $request->visa_country,
            'datevisa_start' => $request->datevisa_start,
            'datevisa_end' => $request->datevisa_end,
            'claim_id' => $request->claim_id,
        ];
        Visa::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function update(Request $request)
    {
        $data = [
            'type' => $request->type,
            'visa_name' => $request->visa_name,
            'visa_country' => $request->visa_country,
            'datevisa_start' => $request->datevisa_start,
            'datevisa_end' => $request->datevisa_end,
            'claim_id' => $request->claim_id,
        ];
        Visa::updateOrCreate([
            'id'  => $request->visa_id,
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
