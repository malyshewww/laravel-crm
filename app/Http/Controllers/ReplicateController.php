<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;

class ReplicateController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->claim_id;
        $claim = Claim::find($id);
        $clone = $claim->duplicate();
        $clone->push();
        return response()->json([
            'status' => 'success'
        ]);
    }
}
