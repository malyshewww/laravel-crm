<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $claims = Claim::get();
        $tel = '+ 7 (952) 761 65 81 dsad';
        $phone = preg_replace('![^0-9]+!', '', $tel);
        return view('claim.index', compact('claims', 'phone'));
    }
}
