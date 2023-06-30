<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'claim_id' => $request->claim_id,
            'city_id' => $request->city_id,
            'country_id' => $request->country_id,
        ];
        TourPackage::updateOrCreate([
            'claim_id' => $request->claim_id
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function loadModal($id, $action)
    {
        $claim = Claim::findOrFail($id);
        if ($claim->tourpackage) {
            $tourpackage = TourPackage::findOrFail($claim->tourpackage->id);
            return view('claim.tourpackage.modals.tourpackage_update', compact('tourpackage', 'claim'))->render();
        } else {
            return view('claim.tourpackage.modals.tourpackage_create', compact('claim'))->render();
        }
    }
}
