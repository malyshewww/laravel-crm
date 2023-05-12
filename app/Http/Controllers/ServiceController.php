<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'type' => $request->type,
            'claim_id' => $request->id
        ];
        Service::create($data);
    }
}
