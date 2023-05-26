<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ClaimController;
use App\Models\Claim;
use App\Models\Touroperator;
use Illuminate\Http\Request;

class TourOperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'claim_id' => $request->claim_id,
            'title' => $request->title,
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
        if ($claim->touroperator) {
            $touroperator = Touroperator::findOrFail($claim->touroperator->id);
            return view('claim.touroperator.modals.touroperator_update', compact('touroperator'))->render();
        } else {
            return view('claim.touroperator.modals.touroperator_create')->render();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
