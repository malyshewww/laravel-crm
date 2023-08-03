<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => '',
            'date_start' => '',
            'date_end' => '',
            'city_id' => '',
            'country_id' => '',
        ]);
        TourPackage::updateOrCreate([
            'claim_id' => $request->claim_id
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function loadModal($id, $action)
    {
        $claim =  Claim::withTrashed()->where('id', $id)->first();
        if ($claim->tourpackage) {
            $tourpackage = TourPackage::findOrFail($claim->tourpackage->id);
            return view('claim.tourpackage.modals.tourpackage_update', compact('tourpackage', 'claim'))->render();
        } else {
            return view('claim.tourpackage.modals.tourpackage_create', compact('claim'))->render();
        }
    }
}
