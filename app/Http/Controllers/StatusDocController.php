<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\StatusDoc;
use Illuminate\Http\Request;

class StatusDocController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'status' => $request->status,
            'claim_id' => $request->claim_id,
        ];
        StatusDoc::updateOrCreate([
            'claim_id' => $request->claim_id
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function loadModal($id, $action)
    {
        $claim = Claim::withTrashed()->where('id', $id)->first();
        return view('claim.doc.modal_doc_update', compact('claim'))->render();
    }
}
