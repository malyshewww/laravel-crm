<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'type' => $request->type,
            'flight_route' => $request->flight_route,
            'flight_start' => $request->flight_start,
            'flight_end' => $request->flight_end,
            'flight_aviacompany' => $request->flight_aviacompany,
            'flight_class' => $request->flight_class,
            'flight_number' => $request->flight_number,
            'dateflight_start' => $request->dateflight_start,
            'dateflight_end' => $request->dateflight_end,
            'claim_id' => $request->claim_id,
        ];
        Flight::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function update(Request $request)
    {
        $data = [
            'type' => $request->type,
            'flight_route' => $request->flight_route,
            'flight_start' => $request->flight_start,
            'flight_end' => $request->flight_end,
            'flight_aviacompany' => $request->flight_aviacompany,
            'flight_class' => $request->flight_class,
            'flight_number' => $request->flight_number,
            'dateflight_start' => $request->dateflight_start,
            'dateflight_end' => $request->dateflight_end,
            'claim_id' => $request->claim_id,
        ];
        Flight::updateOrCreate([
            'id'  => $request->record_id,
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function destroy($id)
    {
        Flight::where('id', $id)->forceDelete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function loadModal($id, $claimId, $action)
    {
        $flight = Flight::findOrFail($id);
        $claim = $action === 'active' ? Claim::findOrFail($claimId)->first() : Claim::withTrashed()->where('id', $claimId)->first();
        return view('claim.services.modals.modal_update_flight', compact('flight', 'claim'))->render();
    }
}
