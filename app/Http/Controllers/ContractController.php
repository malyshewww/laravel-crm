<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'date' => $request->date,
            'number' => $request->number,
            'claim_id' => $request->claim_id,
        ];
        Contract::updateOrCreate([
            'claim_id' => $request->claim_id
        ], $data);
        return response()->json([
            'status' => 'success',
        ]);
    }
    public function loadModal($id, $action)
    {
        $claim = Claim::withTrashed()->where('id', $id)->first();
        if ($claim->contract) {
            $contract = Contract::findOrFail($claim->contract->id);
            return view('claim.contract.modals.contract_update', compact('contract'))->render();
        } else {
            return view('claim.contract.modals.contract_create')->render();
        }
    }
}
