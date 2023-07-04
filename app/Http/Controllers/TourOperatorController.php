<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Touroperator;
use Illuminate\Http\Request;

class TourOperatorController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'claim_id' => $request->claim_id,
            'title' => $request->search_terms ?: $request->title,
        ];
        Touroperator::updateOrCreate([
            'claim_id' => $request->claim_id
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function loadModal($id, $action)
    {
        $claim = Claim::findOrFail($id);
        $touroperators = Touroperator::orderBy('id', 'DESC')->get();
        if ($claim->touroperator) {
            $touroperator = Touroperator::findOrFail($claim->touroperator->id);
            return view('claim.touroperator.modals.touroperator_update', compact('claim', 'touroperators'))->render();
        } else {
            return view('claim.touroperator.modals.touroperator_create', compact('touroperators'))->render();
        }
    }
}
