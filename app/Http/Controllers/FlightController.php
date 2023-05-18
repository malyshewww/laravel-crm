<?php

namespace App\Http\Controllers;

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
            'id'  => $request->flight_id,
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function destroy($id)
    {
        $flight = Flight::findOrFail($id);
        $flight->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
}
