<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Customer;
use App\Models\Person;
use App\Models\Tourist;
use App\Models\TouristDataCommons;
use App\Models\Touroperator;
use App\Models\TourPackage;
use App\Models\Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClaimController extends Controller
{
    public function index(Claim $claim)
    {
        // $claims = DB::table('claims')
        //     ->get()
        //     ->sortByDesc('id');
        // $claims =  Claim::with('latestClaim')->get()->sortByDesc('latestClaim.created_at');
        // $claims =  Claim::with('latestClaim')->get()->sortByDesc('latestClaim.created_at');
        $claims = Claim::get()->sortBy('id');
        $tourpackages = TourPackage::all();
        return view('claim.index', compact('claims', 'tourpackages'));
    }
    public function get_comment(Request $request, $id)
    {
        $claimData = Claim::find($id);
        return response()->json($claimData);
    }
    public function create(Request $request)
    {
        $claimData = Customer::get();
        return response()->json($claimData);
        // return view('claim.create', compact('claimData'));
    }
    public function show(Claim $claim)
    {
        $tourpackages = TourPackage::all();
        $tourists = DB::table('tourists')
            ->join('tourist_data_commons', 'tourists.id', '=', 'tourist_data_commons.tourist_id')
            ->join('claims', 'tourists.claim_id', '=', 'claims.id')
            ->where('tourists.claim_id', '=', 'claims.id')
            ->select(
                'tourists.*',
                'tourist_data_commons.tourist_gender',
                'tourist_data_commons.tourist_surname_lat',
                'tourist_data_commons.tourist_name_lat',
                'tourist_data_commons.tourist_nationality',
                'tourist_data_commons.tourist_birthday',
                'tourist_data_commons.tourist_address',
                'tourist_data_commons.tourist_phone',
                'tourist_data_commons.tourist_email'
            )
            ->get();
        return view('claim.show', compact('claim', 'tourpackages'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date_start' => 'required',
            'date_end' => 'required',
        ]);
        $data = [
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'comment' => $request->comment
        ];
        $json = [];
        $errors = $validator->errors();
        if ($validator->fails()) {
            $json['status'] =  'error';
            if ($errors->has('date_start')) {
                $json['date_start'] = 'error';
            }
            if ($errors->has('date_end')) {
                $json['date_end'] = 'error';
            }
            return response()->json($json);
        }
        Claim::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function update(Request $request, Claim $claim)
    {
        $data = request()->validate([
            'comment' => '',
        ]);
        $claim->update($data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function destroy(Claim $claim)
    {
        $claim->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    // public function createTourOperator(Request $request, Claim $claim)
    // {
    //     $data = request()->validate([
    //         'title' => '',
    //         'claim_id' => '',
    //     ]);
    //     $touroperator = new Touroperator;
    //     $touroperator->id = $request->title;
    //     $touroperator->claim_id = $request->claim_id;
    //     Touroperator::create($data);
    //     // Нужно показать, что пост создался. Для чего - чтобы мы могли указать id для привязки с тегами
    //     // $touropeartor->claim()->attach($id);
    //     return redirect()->to('claims/' . $claim->id);
    // }
    // public function updateTourOperator(Request $request, Touroperator $touroperator)
    // {
    //     $data = request()->validate([
    //         'title' => '',
    //         'claim_id' => '',
    //     ]);
    //     $touroperator->update($data);
    //     dd('updated');
    //     // return redirect()->to('claims/' . $claim->id);
    // }
}
