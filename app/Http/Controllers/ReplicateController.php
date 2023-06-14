<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;

class ReplicateController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->claim_id;
        $claim = Claim::findOrFail($id);
        $claim->load('tourpackage', 'touroperator', 'contract');
        $newModel = $claim->replicate();
        $newModel->push();
        $newModel->save();
        // foreach ($claim->getRelations() as $relation => $items) {
        //     foreach ($items as $item) {
        //         unset($item->id);
        //         $newModel->{$relation}()->create($item->toArray());
        //     }
        // }
        return response()->json([
            'status' => 'success'
        ]);
    }
}
