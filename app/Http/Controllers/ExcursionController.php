<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Excursion;
use Illuminate\Http\Request;

class ExcursionController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'type' => $request->type,
            'excursion_name' => $request->excursion_name,
            'excursion_description' => $request->excursion_description,
            'excursion_date_start' => $request->excursion_date_start,
            'excursion_date_end' => $request->excursion_date_end,
            'claim_id' => $request->claim_id,
        ];
        Excursion::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function update(Request $request)
    {
        $data = [
            'type' => $request->type,
            'excursion_name' => $request->excursion_name,
            'excursion_description' => $request->excursion_description,
            'excursion_date_start' => $request->excursion_date_start,
            'excursion_date_end' => $request->excursion_date_end,
            'claim_id' => $request->claim_id,
        ];
        Excursion::updateOrCreate([
            'id'  => $request->record_id,
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function destroy($id)
    {
        Excursion::where('id', $id)->forceDelete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function loadModal($id, $claimId, $action)
    {
        $excursion = Excursion::findOrFail($id);
        $claim = Claim::withTrashed()->where('id', $claimId)->first();
        return view('claim.services.modals.modal_update_excursion', compact('excursion', 'claim'))->render();
    }
}
