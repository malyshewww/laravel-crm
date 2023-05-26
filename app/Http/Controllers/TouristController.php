<?php

namespace App\Http\Controllers;

use App\Helpers\TouristHelper;
use App\Models\Claim;
use App\Models\Tourist;
use App\Models\TouristDataCertificate;
use App\Models\TouristDataCommons;
use App\Models\TouristDataInternationalPassport;
use App\Models\TouristDataPassport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class TouristController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tourist_surname' => 'required',
            'tourist_name' => 'required',
            'tourist_gender' => 'required',
            'tourist_nationality' => 'required',
            'tourist_birthday' => 'required',
            'visa_info' => 'required'
        ]);
        $errors = $validator->errors();
        $json = [];
        if ($validator->fails()) {
            $json['status'] =  'error';
            if ($errors->has('tourist_surname')) {
                $json['tourist_surname'] = 'error';
            }
            if ($errors->has('tourist_name')) {
                $json['tourist_name'] = 'error';
            }
            if ($errors->has('tourist_gender')) {
                $json['tourist_gender'] = 'error';
            }
            if ($errors->has('tourist_nationality')) {
                $json['tourist_nationality'] = 'error';
            }
            if ($errors->has('tourist_birthday')) {
                $json['tourist_birthday'] = 'error';
            }
            if ($errors->has('visa_info')) {
                $json['visa_info'] = 'error';
            }
            return response()->json($json);
        }
        // Фамилия, Имя, Отчество
        $touristFields = [
            'tourist_surname' => $request->tourist_surname,
            'tourist_name' => $request->tourist_name,
            'tourist_patronymic' => $request->tourist_patronymic,
            'claim_id' => $request->claim_id
        ];
        Tourist::create($touristFields);

        // Общие данные: Пол, Фамилия (LAT), Имя (LAT), Гражданство, Дата рождения, Адрес, Телефон, E-mail, Необходимость визы, Город подачи визы
        $touristDataCommonFields = [
            'tourist_gender' => $request->tourist_gender,
            'tourist_surname_lat' => $request->tourist_surname_lat,
            'tourist_name_lat' => $request->tourist_name_lat,
            'tourist_nationality' => $request->tourist_nationality,
            'tourist_birthday' => $request->tourist_birthday,
            'tourist_address' => $request->tourist_address,
            'tourist_phone' => $request->tourist_phone,
            'tourist_email' => $request->tourist_email,
            'visa_info' => $request->visa_info,
            'visa_city' => $request->visa_city,
            'tourist_id' => $request->tourist_id
        ];
        TouristDataCommons::create($touristDataCommonFields);

        // Паспортные данные: серия, номер, дата выдачи, кем выдан, код подразделения, адрес регистрации
        $touristDataPassportFields = [
            'tourist_passport_series' => $request->tourist_passport_series,
            'tourist_passport_number' => $request->tourist_passport_number,
            'tourist_passport_date' => $request->tourist_passport_date,
            'tourist_passport_issued' => $request->tourist_passport_issued,
            'tourist_passport_code' => $request->tourist_passport_code,
            'tourist_passport_address' => $request->tourist_passport_address,
            'tourist_id' => $request->tourist_id
        ];
        TouristDataPassport::create($touristDataPassportFields);

        // Данные свидетельства о рождении: серия, номер, дата выдачи, кем выдан
        $touristDataCertificateFields = [
            'tourist_certificate_series' => $request->tourist_certificate_series,
            'tourist_certificate_number' => $request->tourist_certificate_number,
            'tourist_certificate_date' => $request->tourist_certificate_date,
            'tourist_certificate_issued' => $request->tourist_certificate_issued,
            'tourist_id' => $request->tourist_id
        ];
        TouristDataCertificate::create($touristDataCertificateFields);

        // Данные заграничного паспорта: серия, номер, дата выдачи, срок действия, кем выдан
        $touristDataInternationalPassportFields = [
            'tourist_international_passport_series' => $request->tourist_international_passport_series,
            'tourist_international_passport_number' => $request->tourist_international_passport_number,
            'tourist_international_passport_date' => $request->tourist_international_passport_date,
            'tourist_international_passport_period' => $request->tourist_international_passport_period,
            'tourist_international_passport_issued' => $request->tourist_international_passport_issued,
            'tourist_id' => $request->tourist_id
        ];
        TouristDataInternationalPassport::create($touristDataInternationalPassportFields);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function update(Request $request, Tourist $tourist)
    {
        $validator = Validator::make($request->all(), [
            'tourist_surname' => 'required',
            'tourist_name' => 'required',
            'tourist_gender' => 'required',
            'tourist_nationality' => 'required',
            'tourist_birthday' => 'required',
            'visa_info' => 'required'
        ]);
        $errors = $validator->errors();
        $json = [];
        if ($validator->fails()) {
            $json['status'] =  'error';
            if ($errors->has('tourist_surname')) {
                $json['tourist_surname'] = 'error';
            }
            if ($errors->has('tourist_name')) {
                $json['tourist_name'] = 'error';
            }
            if ($errors->has('tourist_gender')) {
                $json['tourist_gender'] = 'error';
            }
            if ($errors->has('tourist_nationality')) {
                $json['tourist_nationality'] = 'error';
            }
            if ($errors->has('tourist_birthday')) {
                $json['tourist_birthday'] = 'error';
            }
            if ($errors->has('visa_info')) {
                $json['visa_info'] = 'error';
            }
            return response()->json($json);
        }

        // Фамилия, Имя, Отчество
        Tourist::updateOrCreate([
            'id'  => $request->tourist_id,
        ], [
            'tourist_surname' => $request->tourist_surname,
            'tourist_name' => $request->tourist_name,
            'tourist_patronymic' => $request->tourist_patronymic,
        ]);

        // Общие данные: Пол, Фамилия (LAT), Имя (LAT), Гражданство, Дата рождения, Адрес, Телефон, E-mail, Необходимость визы, Город подачи визы
        TouristDataCommons::updateOrCreate([
            'tourist_id'  => $request->tourist_id,
        ], [
            'tourist_gender' => $request->tourist_gender,
            'tourist_surname_lat' => $request->tourist_surname_lat,
            'tourist_name_lat' => $request->tourist_name_lat,
            'tourist_nationality' => $request->tourist_nationality,
            'tourist_birthday' => $request->tourist_birthday,
            'tourist_address' => $request->tourist_address,
            'tourist_phone' => $request->tourist_phone,
            'tourist_email' => $request->tourist_email,
            'visa_info' => $request->visa_info,
            'visa_city' => $request->visa_city,
        ]);

        // Паспортные данные: серия, номер, дата выдачи, кем выдан, код подразделения, адрес регистрации
        TouristDataPassport::updateOrCreate([
            'tourist_id'  => $request->tourist_id,
        ], [
            'tourist_passport_series' => $request->tourist_passport_series,
            'tourist_passport_number' => $request->tourist_passport_number,
            'tourist_passport_date' => $request->tourist_passport_date,
            'tourist_passport_issued' => $request->tourist_passport_issued,
            'tourist_passport_code' => $request->tourist_passport_code,
            'tourist_passport_address' => $request->tourist_passport_address,
        ]);

        // Данные свидетельства о рождении: серия, номер, дата выдачи, кем выдан
        TouristDataCertificate::updateOrCreate([
            'tourist_id'  => $request->tourist_id,
        ], [
            'tourist_certificate_series' => $request->tourist_certificate_series,
            'tourist_certificate_number' => $request->tourist_certificate_number,
            'tourist_certificate_date' => $request->tourist_certificate_date,
            'tourist_certificate_issued' => $request->tourist_certificate_issued,
        ]);

        // Данные заграничного паспорта: серия, номер, дата выдачи, срок действия, кем выдан
        TouristDataInternationalPassport::updateOrCreate([
            'tourist_id'  => $request->tourist_id,
        ], [
            'tourist_international_passport_series' => $request->tourist_international_passport_series,
            'tourist_international_passport_number' => $request->tourist_international_passport_number,
            'tourist_international_passport_date' => $request->tourist_international_passport_date,
            'tourist_international_passport_period' => $request->tourist_international_passport_period,
            'tourist_international_passport_issued' => $request->tourist_international_passport_issued,
        ]);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function destroy($id)
    {
        $claim = Tourist::findOrFail($id);
        $claim->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function touristData($id)
    {
        $currentTourist = Tourist::find($id);
        $touristGenders = TouristHelper::gender();
        $touristNationalities = TouristHelper::nationality();
        $touristVisas = TouristHelper::visa();
        $cities = TouristHelper::city();
        $arr = [
            'tourist' => $currentTourist,
            'common' => $currentTourist->common,
            'passport' => $currentTourist->passport,
            'certificate' => $currentTourist->certificate,
            'internationalPassport' => $currentTourist->internationalPassport,
            'genders' => $touristGenders,
            'nationalities' => $touristNationalities,
            'visaOpts' => $touristVisas,
            'cities' => $cities,
        ];
        // return json_encode($arr);
        return response()->json([
            'tourist' => $currentTourist,
            'common' => $currentTourist->common,
            'passport' => $currentTourist->passport,
            'certificate' => $currentTourist->certificate,
            'internationalPassport' => $currentTourist->internationalPassport,
            'genders' => $touristGenders,
            'nationalities' => $touristNationalities,
            'visaOpts' => $touristVisas,
            'cities' => $cities,
        ]);
    }
    public function loadModal($id, $action)
    {
        $tourist = Tourist::findOrFail($id);
        return view('claim.tourists.modals.modal_update', compact('tourist'))->render();
    }
}
