<?php

namespace App\Http\Controllers;

use App\Helpers\TourPackageHelper;
use App\Models\Claim;
use App\Models\Company;
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
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ClaimController extends Controller
{
    public function index(Request $request, Claim $claim)
    {
        $data['q'] = $request->query('fio');
        $query = DB::table('customers')
            ->join('claims', 'customers.claim_id', '=', 'claims.id')
            ->join('tourists', 'tourists.claim_id', '=', 'claims.id')
            ->join('persons', 'persons.customer_id', '=', 'customers.id')
            ->join('companies', 'companies.customer_id', '=', 'customers.id')
            ->join('tour_packages', 'tour_packages.claim_id', '=', 'claims.id')
            ->where('customers.claim_id', '=', 'claims.id')
            ->select(
                'claims.*',
                'tourists.*',
                'customers.*',
                'persons.*',
                'companies.*',
                'tour_packages.*',
            )
            // ->where('tourists.claim_id', '=', 'claims.id')
            // ->Orwhere('persons.customer_id', '=', 'customers.id')
            ->get();
        $claims = Claim::get();
        // dd($query);
        $data['claims'] = $query;
        if (Auth::check()) {
            $tourpackages = TourPackage::get();
            return view('claim.index', compact('claims'));
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
            // $tourists = DB::table('tourists')
            //     ->join('tourist_data_commons', 'tourists.id', '=', 'tourist_data_commons.tourist_id')
            //     ->join('claims', 'tourists.claim_id', '=', 'claims.id')
            //     ->where('tourists.claim_id', '=', 'claims.id')
            //     ->select(
            //         'tourists.*',
            //         'tourist_data_commons.tourist_gender',
            //         'tourist_data_commons.tourist_surname_lat',
            //         'tourist_data_commons.tourist_name_lat',
            //         'tourist_data_commons.tourist_nationality',
            //         'tourist_data_commons.tourist_birthday',
            //         'tourist_data_commons.tourist_address',
            //         'tourist_data_commons.tourist_phone',
            //         'tourist_data_commons.tourist_email'
            //     )
            //     ->get();
            $tourists = Tourist::get();
            $customers = Customer::get();
            $persons = Person::get();
            $companies = Company::get();
            return view('claim.show', compact('claim', 'tourpackages', 'tourists', 'customers', 'persons', 'companies'));
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
    public function records(Request $request)
    {
        // $claims = Claim::all();
        $dateStart = $request->date_start;
        $dateEnd = $request->date_end;
        if (isset($dateStart) && isset($dateEnd)) {
            echo $dateStart;
            echo $dateEnd;
        }
        // $claims = [
        //     [
        //         'id' => 1,
        //         'date_start' => 20,
        //         'date_end' => 30,
        //     ],
        //     [
        //         'id' => 2,
        //         'date_start' => 20,
        //         'date_end' => 30,
        //     ],
        // ];
        // $claims = Claim::where('date_start', '=', '2023-05-26')->get();
        // $claims = Claim::join('tourists', 'claims.id', '=', 'tourists.claim_id')
        //     ->select('claims.*', 'tourists.*')
        //     ->get();
        $from = date('2023-05-12');
        $to = date('2023-05-26');
        $claims = Claim::join('tourists', 'tourists.claim_id', '=', 'claims.id')
            ->join('customers', 'customers.claim_id', '=', 'claims.id')
            // ->join('tour_packages', 'tour_packages.claim_id', '=', 'claims.id')
            // ->join('persons', 'persons.customer_id', '=', 'customers.id')
            // ->join('companies', 'companies.customer_id', '=', 'customers.id')
            // ->where('tourists.tourist_surname', 'LIKE', '%С%')
            ->select(
                'tourists.*',
                'customers.*',
                // 'tour_packages.*',
                // 'persons.*',
                // 'companies.*',
                // 'claims.*'
            )
            // ->where('date_start', '>=', $from)->where('date_end', '<=', $to)
            ->get();
        // $claims = Claim::whereHas('tourist', $filter = function ($query) {
        //     $query->where('claim_id', '=', '2');
        // })
        //     ->with(['tourist' => $filter])
        //     ->get();
        $clms = Claim::all();
        $arr = [];
        foreach ($clms as $claim) {
            $tourists = [];
            $stringTourists = '';
            if (count($claim->tourist) > 0) {
                foreach ($claim->tourist as $item) {
                    $currentTourist = [
                        'surname' => $item->tourist_surname,
                        'name' => Str::limit($item->tourist_name, 1, '.'),
                        'patronymic' => Str::limit($item->tourist_patronymic, 1, '.')
                    ];
                    array_push($tourists, $currentTourist);
                }
                foreach ($tourists as $item) {
                    $stringTourists .= $item['surname'] . ' ';
                    $stringTourists .= $item['name'] . ' ';
                    $stringTourists .= $item['patronymic'];
                    if (count($tourists) > 1) {
                        $stringTourists .= ", ";
                    }
                }
            }
            $start_ts = strtotime($claim->date_start);
            $end_ts = strtotime($claim->date_end);
            $diff = $end_ts - $start_ts;
            $resultDiff = round($diff / 86400);
            $city = '';
            $country = '';
            $customer = '';
            if ($claim->tourpackage) {
                $cities = TourPackageHelper::city();
                $countries = TourPackageHelper::country();
                foreach ($cities as $keyCity => $c) {
                    if ($keyCity == $claim->tourpackage->city_id) {
                        $city = $c['name'];
                    }
                }
                foreach ($countries as $keyCountry => $c) {
                    if ($keyCountry == $claim->tourpackage->country_id) {
                        $country = $c['name'];
                    }
                }
            }
            if ($claim->customer) {
                $customer = 'person';
                if ($claim->customer == 'person' && $claim->customer->person) {
                    // $customer = $claim->customer->person->person_surname . ' ' . $claim->customer->person->person_name . ' ' . $claim->customer->person->person_patronymic;
                    $customer = 'person';
                }
                if ($claim->customer == 'company') {
                    $customer = 'company';
                }
            }
            $arr[] = [
                'id' => $claim->id,
                'date_start' => $claim->date_start,
                'date_end' => $claim->date_end,
                'manager' => $claim->manager,
                'created_at' => $claim->created_at,
                'tourists' => $stringTourists,
                'night' => $resultDiff . ' ' . Lang::choice('ночь|ночи|ночей', $resultDiff, [], 'ru'),
                'city' => $city,
                'country' => $country,
                'customer' => $customer
            ];
        }
        return json_encode($arr, true);
    }
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
