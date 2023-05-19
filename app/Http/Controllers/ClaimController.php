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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ClaimController extends Controller
{
    public function index(Claim $claim)
    {
        // $claims =  Claim::with('latestClaim')->get()->sortByDesc('latestClaim.created_at');
        // $claims =  Claim::with('latestClaim')->get()->sortByDesc('latestClaim.created_at');
        // $claims = Claim::paginate(5);
        if (Auth::check()) {
            $claims = Claim::get();
            DB::table('claims')
                ->where('id', $claim->id)
                ->update(['deleted_at' => null]);
            $tourpackages = TourPackage::get();
            return view('claim.index', compact('claims', 'tourpackages'));
        }
        return redirect()->route('user.login');
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
        if (Auth::check()) {
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
            if (count($claim->paymentInvoices) > 0) {
                $currencyRUB = [];
                $currencyUSD = [];
                $currencyEUR = [];
                foreach ($claim->paymentInvoices as $key => $item) {
                    if ($item->currency === 'RUB') {
                        $currencyRUB[] = $item->sum('sum');
                    }
                    if ($item->currency === 'USD') {
                        $currencyUSD[] = $item->sum('sum');
                    }
                    if ($item->currency === 'EUR') {
                        $currencyEUR[] = $item->sum('sum');
                    }
                }
            }
            $resultSumRUB = array_sum($currencyRUB);
            $resultSumUSD = array_sum($currencyUSD);
            $resultSumEUR = array_sum($currencyEUR);
            return view('claim.show', compact('claim', 'tourpackages'));
        }
        return redirect()->route('user.login');
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
            'comment' => $request->comment,
            'manager' => $request->manager
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
    public function destroy($id)
    {
        $claim = Claim::findOrFail($id);
        $claim->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }

    // Fetch DataTable data
    public function getClaims(Request $request)
    {
        return response()->json([
            'data' => 'success'
        ]);
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Custom search filter 
        $searchCity = $request->get('fio');
        $searchGender = $request->get('date_start');
        $searchName = $request->get('date_end');

        // Total records
        $records = Claim::select('count(*) as allcount');

        ## Add custom filter conditions
        if (!empty($searchCity)) {
            $records->where('city', $searchCity);
        }
        if (!empty($searchGender)) {
            $records->where('gender', $searchGender);
        }
        if (!empty($searchName)) {
            $records->where('name', 'like', '%' . $searchName . '%');
        }
        $totalRecords = $records->count();

        // Total records with filter
        $records = Claim::select('count(*) as allcount')->where('name', 'like', '%' . $searchValue . '%');

        ## Add custom filter conditions
        if (!empty($searchCity)) {
            $records->where('city', $searchCity);
        }
        if (!empty($searchGender)) {
            $records->where('gender', $searchGender);
        }
        if (!empty($searchName)) {
            $records->where('name', 'like', '%' . $searchName . '%');
        }
        $totalRecordswithFilter = $records->count();

        // Fetch records
        $records = Claim::orderBy($columnName, $columnSortOrder)
            ->select('claims.*')
            ->where('claims.date_start', 'like', '%' . $searchValue . '%');
        ## Add custom filter conditions
        if (!empty($searchCity)) {
            $records->where('city', $searchCity);
        }
        if (!empty($searchGender)) {
            $records->where('gender', $searchGender);
        }
        if (!empty($searchName)) {
            $records->where('name', 'like', '%' . $searchName . '%');
        }
        $employees = $records->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        foreach ($employees as $employee) {

            $username = $employee->username;
            $name = $employee->name;
            $email = $employee->email;
            $gender = $employee->gender;
            $city = $employee->city;

            $data_arr[] = array(
                "username" => $username,
                "name" => $name,
                "email" => $email,
                "gender" => $gender,
                "city" => $city,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        return response()->json($response);
    }
}
