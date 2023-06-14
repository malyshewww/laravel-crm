<?php

namespace App\Http\Controllers;

use App\Helpers\TourPackageHelper;
use App\Models\Claim;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Person;
use App\Models\Tourist;
use App\Models\Touroperator;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ClaimController extends Controller
{
    public function index(Request $request, Claim $claim)
    {
        $claims = Claim::get();
        return view('claim.index', compact('claims'));
    }
    public function get_comment(Request $request, $id)
    {
        $claimData = Claim::find($id);
        return response()->json($claimData);
    }
    public function show(Claim $claim)
    {
        $tourpackages = TourPackage::all();
        $tourists = Tourist::get();
        $customers = Customer::get();
        $persons = Person::get();
        $companies = Company::get();
        return view('claim.show', compact('claim', 'tourpackages', 'tourists', 'customers', 'persons', 'companies'));
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
            $json['status'] = 'error';
            foreach ($errors->getMessages() as $key => $message) {
                $json[$key] = 'error';
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
    public function loadModal($id, $action)
    {
        $claim = Claim::findOrFail($id);
        return view('claim.comment.modals.modal_comment_update', compact('claim'))->render();
    }
    // Fetch DataTable data
    public function records(Request $request)
    {
        $dateStart = $request->input('date_start');
        $dateEnd = $request->input('date_end');
        $fioTourist = $request->input('fio');
        $result = Claim::get();
        $now = date('Y-m-d');
        if (isset($dateStart) || isset($dateEnd) || isset($fioTourist)) {
            $from = $dateStart ? date($dateStart) : '';
            $to = $dateEnd ? date($dateEnd) : '';
            $fio = $fioTourist ? $fioTourist : '';
            $query = Claim::select('claims.*');
            $query
                ->where(function ($query) use ($from, $to) {
                    return $query->where('date_start', '>=', $from)
                        ->orWhere('date_end', '<=', $to);
                })
                ->when(!empty($from), function ($query) use ($from) {
                    return $query->where('date_start', '>=', $from);
                })
                ->when(!empty($to), function ($query) use ($to) {
                    return $query->where('date_end', '<=', $to);
                });
            if (!empty($fio)) {
                $query->whereHas('tourist', function ($query) use ($fio) {
                    $query->where('tourist_surname', 'LIKE', '%' . $fio . '%');
                    $query->orWhere('tourist_name', 'LIKE', '%' . $fio . '%');
                    $query->orWhere('tourist_patronymic', 'LIKE', '%' . $fio . '%');
                });
            }
            $result = $query->get();
            // $query->where(function ($query) use ($from, $to) {
            //     return $query->where(
            //         ['date_start', '>=', $from],
            //         ['date_end', '<=', $to]
            //     );
            // });
            // $query->where(function ($query) use ($from, $to) {
            //     return $query->where('date_start', '>=', $from)
            //         ->orWhere('date_end', '<=', $to);
            //     // ->orWhere('tourists.tourist_surname', 'LIKE', '%' . $fio . '%')
            //     // ->orWhere('tourists.tourist_name', 'LIKE', '%' . $fio . '%')
            //     // ->orWhere('tourists.tourist_patronymic', 'LIKE', '%' . $fio . '%');
            // });
            // $claims = Claim::whereHas('tourist', $filter = function ($query) {
            //     $query->where('claim_id', '=', '2');
            // })
            //     ->with(['tourist' => $filter])
            //     ->get();
        }
        $arr = [];
        foreach ($result as $claim) {
            $tourists = [];
            $stringTourists = '';
            if (isset($claim->tourist) && count($claim->tourist) > 0) {
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
            $manager = '';
            if (isset($claim->tourpackage)) {
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
            if (isset($claim->customer)) {
                if ($claim->customer->type == 'person' && $claim->person) {
                    $customer = $claim->person->person_surname . ' ' . $claim->person->person_name . ' ' . $claim->person->person_patronymic;
                } else if ($claim->customer->type == 'company' && $claim->company) {
                    $customer = $claim->company->company_fullname ?: '';
                } else {
                    $customer = '';
                }
            }
            if (isset($claim->manager)) {
                $manager = Auth::user()->name;
            }
            $arr[] = [
                'id' => $claim->id,
                'claim_number' => $claim->id . '-' . date('Y'),
                'date_start' => $claim->date_start,
                'date_end' => $claim->date_end,
                'manager' => $claim->manager,
                'created_at' => $claim->created_at,
                'tourists' => $stringTourists,
                'countTourists' => count($tourists),
                'night' => $resultDiff . ' ' . Lang::choice('ночь|ночи|ночей', $resultDiff, [], 'ru'),
                'city' => $city,
                'country' => $country,
                'customer' => $customer,
                'manager' => $manager,
            ];
        }
        return json_encode($arr, true);
    }
}
