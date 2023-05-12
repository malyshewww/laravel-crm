<?php

namespace App\Http\Controllers;

use App\Models\OtherService;
use Illuminate\Http\Request;

class OtherServiceController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'type' => $request->type,
            'other_service_name' => $request->other_service_name,
            'otherservice_date_start' => $request->otherservice_date_start,
            'otherservice_date_end' => $request->otherservice_date_end,
            'claim_id' => $request->claim_id,
        ];
        OtherService::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function update(Request $request)
    {
        $data = [
            'type' => $request->type,
            'other_service_name' => $request->other_service_name,
            'otherservice_date_start' => $request->otherservice_date_start,
            'otherservice_date_end' => $request->otherservice_date_end,
            'claim_id' => $request->claim_id,
        ];
        OtherService::updateOrCreate([
            'id'  => $request->other_id,
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
