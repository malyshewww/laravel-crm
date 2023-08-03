<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Habitation;
use Illuminate\Http\Request;

class HabitationController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'type' => $request->type,
            'habitation_name' => $request->habitation_name,
            'habitation_resort' => $request->habitation_resort,
            'habitation_hotel' => $request->habitation_hotel,
            'habitation_hotel_address' => $request->habitation_hotel_address,
            'habitation_type_number' => $request->habitation_type_number,
            'habitation_type_placement' => $request->habitation_type_placement,
            'habitation_type_food' => $request->habitation_type_food,
            'datehabitation_start' => $request->datehabitation_start,
            'datehabitation_end' => $request->datehabitation_end,
            'claim_id' => $request->claim_id,
        ];
        Habitation::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function update(Request $request)
    {
        $data = [
            'type' => $request->type,
            'habitation_name' => $request->habitation_name,
            'habitation_resort' => $request->habitation_resort,
            'habitation_hotel' => $request->habitation_hotel,
            'habitation_hotel_address' => $request->habitation_hotel_address,
            'habitation_type_number' => $request->habitation_type_number,
            'habitation_type_placement' => $request->habitation_type_placement,
            'habitation_type_food' => $request->habitation_type_food,
            'datehabitation_start' => $request->datehabitation_start,
            'datehabitation_end' => $request->datehabitation_end,
            'claim_id' => $request->claim_id,
        ];
        Habitation::updateOrCreate([
            'id'  => $request->record_id,
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function destroy($id)
    {
        Habitation::where('id', $id)->forceDelete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function loadModal($id, $claimId, $action)
    {
        $habitation = Habitation::findOrFail($id);
        $claim = Claim::withTrashed()->where('id', $claimId)->first();
        return view('claim.services.modals.modal_update_habitation', compact('habitation', 'claim'))->render();
    }
}
