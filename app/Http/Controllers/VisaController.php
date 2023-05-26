<?php

namespace App\Http\Controllers;

use App\Models\Visa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisaController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'type' => $request->type,
            'visa_name' => $request->visa_name,
            'visa_country' => $request->visa_country,
            'datevisa_start' => $request->datevisa_start,
            'datevisa_end' => $request->datevisa_end,
            'claim_id' => $request->claim_id,
        ];
        Visa::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function update(Request $request)
    {
        $data = [
            'type' => $request->type,
            'visa_name' => $request->visa_name,
            'visa_country' => $request->visa_country,
            'datevisa_start' => $request->datevisa_start,
            'datevisa_end' => $request->datevisa_end,
            'claim_id' => $request->claim_id,
        ];
        Visa::updateOrCreate([
            'id'  => $request->record_id,
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function destroy($id)
    {
        $visa = Visa::findOrFail($id);
        $visa->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function loadModal($id, $action)
    {
        $visa = Visa::findOrFail($id);
        $tourists = DB::table('tourists')
            ->join('claims', 'tourists.claim_id', '=', 'claims.id')
            ->select('tourists.*')
            ->get();
        return view('claim.services.modals.modal_update_visa', compact('visa', 'tourists'))->render();
    }
}
