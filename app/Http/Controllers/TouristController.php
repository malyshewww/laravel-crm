<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Tourist;
use App\Models\TouristDataCertificate;
use App\Models\TouristDataCommons;
use App\Models\TouristDataInternationalPassport;
use App\Models\TouristDataPassport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TouristController extends Controller
{
    public function store(Request $request, Claim $claim)
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
            $json['status'] = 'error';
            foreach ($errors->getMessages() as $key => $message) {
                $json[$key] = 'error';
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
        $tourist_phone = $claim->validateNumber($request->tourist_phone);
        $touristDataCommonFields = [
            'tourist_gender' => $request->tourist_gender,
            'tourist_surname_lat' => $request->tourist_surname_lat,
            'tourist_name_lat' => $request->tourist_name_lat,
            'tourist_nationality' => $request->tourist_nationality,
            'tourist_birthday' => $request->tourist_birthday,
            'tourist_address' => $request->tourist_address,
            'tourist_phone' => $tourist_phone,
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

    public function update(Request $request, Claim $claim)
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
            $json['status'] = 'error';
            foreach ($errors->getMessages() as $key => $message) {
                $json[$key] = 'error';
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
        $tourist_phone = $claim->validateNumber($request->tourist_phone);
        TouristDataCommons::updateOrCreate([
            'tourist_id'  => $request->tourist_id,
        ], [
            'tourist_gender' => $request->tourist_gender,
            'tourist_surname_lat' => $request->tourist_surname_lat,
            'tourist_name_lat' => $request->tourist_name_lat,
            'tourist_nationality' => $request->tourist_nationality,
            'tourist_birthday' => $request->tourist_birthday,
            'tourist_address' => $request->tourist_address,
            'tourist_phone' => $tourist_phone,
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
        Tourist::where('id', $id)->forceDelete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function loadModal($id, $action)
    {
        $tourist = Tourist::findOrFail($id);
        return view('claim.tourists.tourist_update', compact('tourist'))->render();
    }
    public function touristSearch(Request $request)
    {
        $value = $request->value;
        $tourists = Tourist::where('tourist_surname', 'LIKE', '%' . $value . '%')->get();
        return $tourists ? json_encode($tourists) : [];
    }
    public function touristData($id, $action)
    {
        if ($action === 'old') {
            $tourist = Tourist::findOrFail($id);
            return view('claim.tourists.tourist_update', compact('tourist'))->render();
        } else {
            return view('claim.tourists.tourist_new')->render();
        }
    }
}
