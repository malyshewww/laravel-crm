<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function store(Request $request)
    {
        $data = request()->validate([
            'date' => '',
            'number' => '',
            'claim_id' => '',
        ]);
        Contract::updateOrCreate([
            'claim_id' => $request->claim_id
        ], [
            'date' => $request->date,
            'number' => $request->number,
        ]);
        return redirect()->back();
    }
}
