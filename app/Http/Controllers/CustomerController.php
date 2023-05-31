<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyDataBank;
use App\Models\CompanyDataContact;
use App\Models\CompanyDataRegister;
use App\Models\Customer;
use App\Models\Person;
use App\Models\PersonCertificate;
use App\Models\PersonCommons;
use App\Models\PersonInternationalPassport;
use App\Models\PersonPassport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function store(Request $request)
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
        if ($request->input('type') == 'person') {
            $validator = Validator::make($request->all(), [
                'person_surname' => 'required',
                'person_name' => 'required',
                'person_gender' => 'required',
                'person_nationality' => 'required',
                'person_birthday' => 'required',
            ]);
            $errors = $validator->errors();
            $json = [];
            if ($validator->fails()) {
                $json['status'] =  'error';
                if ($errors->has('person_surname')) {
                    $json['person_surname'] = 'error';
                }
                if ($errors->has('person_name')) {
                    $json['person_name'] = 'error';
                }
                if ($errors->has('person_gender')) {
                    $json['person_gender'] = 'error';
                }
                if ($errors->has('person_nationality')) {
                    $json['person_nationality'] = 'error';
                }
                if ($errors->has('person_birthday')) {
                    $json['person_birthday'] = 'error';
                }
                return response()->json($json);
            }
            $personFields = [
                'person_surname' => $request->person_surname,
                'person_name' =>  $request->person_name,
                'person_patronymic' => $request->person_patronymic,
                'customer_id' => $request->customer_id
            ];
            Person::updateOrCreate([
                'customer_id' => $request->customer_id
            ], $personFields);
            // Общие данные о заказчике
            $personCommonsFields = [
                'person_gender' => $request->person_gender,
                'person_surname_lat' => $request->person_surname_lat,
                'person_name_lat' => $request->person_name_lat,
                'person_nationality' => $request->person_nationality,
                'person_birthday' => $request->person_birthday,
                'person_address' => $request->person_address,
                'person_phone' => $request->person_phone,
                'person_email' => $request->person_email,
                'person_id' => $request->person_id,
            ];
            PersonCommons::updateOrCreate([
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
                'person_id' => $request->person_id,
            ];
            PersonPassport::updateOrCreate([
                'person_id' => $request->person_id,
            ], $personPassportFields);
            // // Данные свидетельства о рождении заказчика
            $personCertificateFields = [
                'person_certificate_series' => $request->person_certificate_series,
                'person_certificate_number' => $request->person_certificate_number,
                'person_certificate_date' => $request->person_certificate_date,
                'person_certificate_issued' => $request->person_certificate_issued,
                'person_id' => $request->person_id,
            ];
            PersonCertificate::updateOrCreate([
                'person_id' => $request->person_id,
            ], $personCertificateFields);
            // // Данные заграничного паспорта заказчика
            $personInternationalPassportFields = [
                'person_international_passport_series' => $request->person_international_passport_series,
                'person_international_passport_number' => $request->person_international_passport_number,
                'person_international_passport_date' => $request->person_international_passport_date,
                'person_international_passport_period' => $request->person_international_passport_period,
                'person_international_passport_issued' => $request->person_international_passport_issued,
                'person_id' => $request->person_id,
            ];
            PersonInternationalPassport::updateOrCreate([
                'person_id' => $request->person_id,
            ], $personInternationalPassportFields);
            return response()->json([
                'status' => 'success'
            ]);
            // Если заказчик - Юр. лицо
        } else if ($request->input('type') == 'company') {
            $companyFields = [
                'company_fullname' => $request->company_fullname,
                'company_shortname' => $request->company_shortname,
                'customer_id' => $request->customer_id
            ];
            Company::updateOrCreate([
                'customer_id' => $request->customer_id
            ], $companyFields);
            $companyRegisterFields = [
                'company_kpp' => $request->company_kpp,
                'company_inn' => $request->company_inn,
                'company_ogrn' => $request->company_ogrn,
                'company_id' => $request->company_id
            ];
            CompanyDataRegister::updateOrCreate([
                'company_id' => $request->company_id
            ], $companyRegisterFields);
            $companyBankFields = [
                'company_bank' => $request->company_bank,
                'company_bik' => $request->company_bik,
                'company_rs' => $request->company_rs,
                'company_ks' => $request->company_ks,
                'company_id' => $request->company_id
            ];
            CompanyDataBank::updateOrCreate([
                'company_id' => $request->company_id
            ], $companyBankFields);
            $companyContactFields = [
                'company_address' => $request->company_address,
                'company_actual_address' => $request->company_actual_address,
                'company_director' => $request->company_director,
                'company_phone' => $request->company_phone,
                'company_email' => $request->company_email,
                'company_id' => $request->company_id
            ];
            CompanyDataContact::updateOrCreate([
                'company_id' => $request->company_id
            ], $companyContactFields);
            return response()->json([
                'status' => 'success'
            ]);
        }
    }
    public function customerData($id)
    {
        $customer = Customer::find($id);
        return response()->json([
            'commons' => $customer->person->commons,
            'passport' => $customer->person->passport,
            'certificate' => $customer->person->certificate,
            'internationalPassport' => $customer->person->internationalPassport,
        ]);
    }
}
