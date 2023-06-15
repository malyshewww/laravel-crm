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
        // foreach ($claim->touroperator as $item) {
        //     $clone->touroperator()->attach($item);
        // }
        // foreach ($item->tourpackage as $item) {
        //     $clone->tourpackage()->attach($item);
        // }
        // foreach ($item->contract as $item) {
        //     $clone->contract()->attach($item);
        // }
        $clone->push();
        // $clone->save();
        return response()->json([
            'status' => 'success'
        ]);
    }
}
