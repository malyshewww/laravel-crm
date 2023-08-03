<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'type' => $request->type,
            'transfer_route' => $request->transfer_route,
            'datetransfer_start' => $request->datetransfer_start,
            'datetransfer_end' => $request->datetransfer_end,
            'transfer_type' => $request->transfer_type,
            'transfer_transport' => $request->transfer_transport,
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
            'transfer_route' => $request->transfer_route,
            'datetransfer_start' => $request->datetransfer_start,
            'datetransfer_end' => $request->datetransfer_end,
            'transfer_type' => $request->transfer_type,
            'transfer_transport' => $request->transfer_transport,
            'claim_id' => $request->claim_id,
        ];
        Transfer::updateOrCreate([
            'id'  => $request->record_id,
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function destroy($id)
    {
        Transfer::where('id', $id)->forceDelete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function loadModal($id, $claimId, $action)
    {
        $claim = Claim::withTrashed()->where('id', $claimId)->first();
        $transfer = Transfer::findOrFail($id);
        return view('claim.services.modals.modal_update_transfer', compact('transfer', 'claim'))->render();
    }
}
