<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Claim;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Person;
use App\Models\PersonDataCertificate;
use App\Models\PersonDataCommons;
use App\Models\PersonDataInternationalPassport;
use App\Models\PersonDataPassport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function store(Request $request, Claim $claim)
    {
        // Тип заказчик - Физ. лицо / Юр. лицо
        $customerFields = [
            'type' => $request->type,
            'claim_id' => $request->claim_id,
        ];
        Customer::updateOrCreate([
            'claim_id' => $request->claim_id
        ], $customerFields);
        // Если заказчик - Физ. лицо
        if ($request->type == 'person') {
            $validator = Validator::make($request->all(), [
                'person_surname' => 'bail|required',
                'person_name' => 'bail|required',
                'person_gender' => 'bail|required',
                'person_nationality' => 'bail|required',
                'person_birthday' => 'required',
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
            $personFields = [
                'person_surname' => $request->person_surname,
                'person_name' =>  $request->person_name,
                'person_patronymic' => $request->person_patronymic,
                // 'claim_id' => $request->claim_id
            ];
            Person::updateOrCreate([
                'claim_id' => $request->claim_id
            ], $personFields);
            // Общие данные о заказчике
            $person_phone = $claim->validateNumber($request->person_phone);
            $personCommonsFields = [
                'person_gender' => $request->person_gender,
                'person_surname_lat' => $request->person_surname_lat,
                'person_name_lat' => $request->person_name_lat,
                'person_nationality' => $request->person_nationality,
                'person_birthday' => $request->person_birthday,
                'person_address' => $request->person_address,
                'person_phone' => $person_phone,
                'person_email' => $request->person_email,
            ];
            PersonDataCommons::updateOrCreate([
                'person_id' => $request->person_id,
            ], $personCommonsFields);
            // // Данные национального паспорта заказчика
            $personPassportFields = [
                'person_passport_series' => $request->person_passport_series,
                'person_passport_number' => $request->person_passport_number,
                'person_passport_date' => $request->person_passport_date,
                'person_passport_issued' => $request->person_passport_issued,
                'person_passport_code' => $request->person_passport_code,
                'person_passport_address' => $request->person_passport_address,
            ];
            PersonDataPassport::updateOrCreate([
                'person_id' => $request->person_id,
            ], $personPassportFields);
            // // Данные свидетельства о рождении заказчика
            $personCertificateFields = [
                'person_certificate_series' => $request->person_certificate_series,
                'person_certificate_number' => $request->person_certificate_number,
                'person_certificate_date' => $request->person_certificate_date,
                'person_certificate_issued' => $request->person_certificate_issued,
            ];
            PersonDataCertificate::updateOrCreate([
                'person_id' => $request->person_id,
            ], $personCertificateFields);
            // // Данные заграничного паспорта заказчика
            $personInternationalPassportFields = [
                'person_international_passport_series' => $request->person_international_passport_series,
                'person_international_passport_number' => $request->person_international_passport_number,
                'person_international_passport_date' => $request->person_international_passport_date,
                'person_international_passport_period' => $request->person_international_passport_period,
                'person_international_passport_issued' => $request->person_international_passport_issued,
            ];
            PersonDataInternationalPassport::updateOrCreate([
                'person_id' => $request->person_id,
            ], $personInternationalPassportFields);
            return response()->json([
                'status' => 'success'
            ]);
            // Если заказчик - Юр. лицо
        }
        if ($request->type == 'company') {
            $company_phone = $claim->validateNumber($request->company_phone);
            $companyFields = [
                'company_fullname' => $request->company_fullname,
                'company_shortname' => $request->company_shortname,
                'company_kpp' => $request->company_kpp,
                'company_inn' => $request->company_inn,
                'company_ogrn' => $request->company_ogrn,
                'company_bank' => $request->company_bank,
                'company_bik' => $request->company_bik,
                'company_rs' => $request->company_rs,
                'company_ks' => $request->company_ks,
                'company_address' => $request->company_address,
                'company_actual_address' => $request->company_actual_address,
                'company_director' => $request->company_director,
                'company_phone' => $company_phone,
                'company_email' => $request->company_email,
                'claim_id' => $request->claim_id
            ];
            Company::updateOrCreate([
                'claim_id' => $request->claim_id
            ], $companyFields);
            return response()->json([
                'status' => 'success'
            ]);
        }
    }
    public function loadModal($id, $action)
    {
        $claim = Claim::findOrFail($id);
        $persons = Person::get();
        $companies = Company::get();
        return view('claim.customer.modal_update_customer', compact('claim', 'persons', 'companies'))->render();
    }
    public function personSearch(Request $request)
    {
        $value = $request->value;
        $persons = Person::where('person_surname', 'LIKE', '%' . $value . '%')->get();
        return $persons ? json_encode($persons) : [];
    }
    public function companySearch(Request $request)
    {
        $value = $request->value;
        $companies = Company::where('company_fullname', 'LIKE', '%' . $value . '%')->get();
        return $companies ? json_encode($companies) : [];
    }
    // public function customerData($id)
    // {
    //     $customer = Customer::find($id);
    //     return response()->json([
    //         'commons' => $customer->person->commons,
    //         'passport' => $customer->person->passport,
    //         'certificate' => $customer->person->certificate,
    //         'internationalPassport' => $customer->person->internationalPassport,
    //     ]);
    // }
}
