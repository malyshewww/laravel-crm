<?php

namespace App\Http\Controllers;

use App\Models\Claim;
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
            'id'  => $request->record_id,
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function destroy($id)
    {
        OtherService::where('id', $id)->forceDelete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function loadModal($id, $claimId, $action)
    {
        $other = OtherService::findOrFail($id);
        $claim = Claim::withTrashed()->where('id', $claimId)->first();
        return view('claim.services.modals.modal_update_other', compact('other', 'claim'))->render();
    }
}
