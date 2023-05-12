<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'type' => $request->type,
            'transfer_route_start' => $request->transfer_route_start,
            'transfer_route_end' => $request->transfer_route_end,
            'datetransfer_start' => $request->datetransfer_start,
            'datetransfer_end' => $request->datetransfer_end,
            'transfer_type' => $request->transfer_type,
            'transfer_transport_start' => $request->transfer_transport_start,
            'transfer_transport_end' => $request->transfer_transport_end,
            'claim_id' => $request->claim_id,
        ];
        Transfer::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function update(Request $request)
    {
        $data = [
            'type' => $request->type,
            'transfer_route_start' => $request->transfer_route_start,
            'transfer_route_end' => $request->transfer_route_end,
            'datetransfer_start' => $request->datetransfer_start,
            'datetransfer_end' => $request->datetransfer_end,
            'transfer_type' => $request->transfer_type,
            'transfer_transport_start' => $request->transfer_transport_start,
            'transfer_transport_end' => $request->transfer_transport_end,
            'claim_id' => $request->claim_id,
        ];
        Transfer::updateOrCreate([
            'id'  => $request->transfer_id,
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
