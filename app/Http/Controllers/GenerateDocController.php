<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;
use App\Helpers\ServiceHelper;
use App\Helpers\TouristHelper;
// use PhpOffice\PhpWord\PhpWord;
// use PhpOffice\PhpWord\Writer\Word2007;

class GenerateDocController extends Controller
{
    public function docExport(Request $request)
    {
        $docType = $request->doc_type;
        // Creating the new document...
        $fileName = '';
        if ($docType == 'doc_avia') {
            $fileName = 'contract_avia';
        } else if ($docType == 'doc_bus') {
            $fileName = 'contract_bus';
        }
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('contracts/' . $fileName . '.docx');
        $phpOfficeWord = new \PhpOffice\PhpWord\PhpWord();
        $contractData = [];
        $claimId = $request->id;
        $claim = Claim::find($claimId);
        $contractData['claimId'] = $claim->id;
        $contractData['claimDate'] = $claim->date_start->format('d.m.Y');
        // Общие данные по заявке, когда заказчик - ФИЗ. ЛИЦО
        if ($claim->customer && $claim->customer->type === 'person') {
            if ($claim->customer->person) {
                $contractData['personSurname'] = $claim->customer->person->person_surname ?: 'Фамилия';
                $contractData['personName'] = $claim->customer->person->person_name ?: 'Имя';
                $contractData['personPatronymic'] = $claim->customer->person->person_patronymic ?: 'Отчество';
                $contractData['personPassportSeries'] = $claim->customer->person->passport->person_passport_series ?: '-';
                $contractData['personPassportNumber'] = $claim->customer->person->passport->person_passport_number ?: '-';
                $contractData['personPassportIssued'] = $claim->customer->person->passport->person_passport_issued ?: '-';
                $contractData['personPassportDate'] = $claim->customer->person->passport->person_passport_date ?: '-';
                $contractData['personPassportAddress'] = $claim->customer->person->passport->person_passport_address ?: '-';
                $contractData['personAddress'] = $claim->customer->person->commons->person_address ?: '-';
                $contractData['personPhone'] = $claim->customer->person->commons->person_phone ?: '-';
                $contractData['personEmail'] = $claim->customer->person->commons->person_email ?: '-';
            }
        }
        $arrTourist = [];
        $touristList = '';
        if ($claim->tourist && count($claim->tourist) > 0) {
            foreach ($claim->tourist as $item) {
                $currentTourist = $item->tourist_surname . ' ' . $item->tourist_name . ' ' . $item->tourist_patronymic;
                array_push($arrTourist, $currentTourist);
            }
            $touristList = join(',', $arrTourist);
        }
        // Услуга "Экскурсионная программа"
        $excursionTableData = [];
        if (count($claim->serviceExcursion) > 0) {
            foreach ($claim->serviceExcursion as $item) {
                $excursionTableData[] = [
                    'excursionDescription' => $item->excursion_description
                ];
            }
        }
        // Данные Турпакета
        $tourPackageTableData = [];
        if ($claim->tourpackage) {
            $tourPackageTableData['tourpackageName'] = $claim->tourpackage->name;
            $tourPackageTableData['claimDateStart'] = $claim->date_start->format('d.m.Y');
            $tourPackageTableData['claimDateEnd'] = $claim->date_end->format('d.m.Y');
        }
        // Услуга "Проживание"
        $habitationTableData = [];
        if (count($claim->serviceHabitation) > 0) {
            foreach ($claim->serviceHabitation as $item) {
                $habitationTableData[] = [
                    'habitationHotel' => $item->habitation_hotel,
                    'habitationResort' => $item->habitation_resort,
                    'habitationTypeNumber' => $item->habitation_type_number,
                    'habitationTypePlacement' => $item->habitation_type_placement,
                    'habitationTypeFood' => $item->habitation_type_food,
                ];
            }
        }
        // Услуга "страховка"
        $insuranceTableData = [];
        $serviceInsuranceHelperTypes = ServiceHelper::insuranceType();
        if (count($claim->serviceInsurance) > 0) {
            $type = '';
            foreach ($claim->serviceInsurance as $item) {
                foreach ($serviceInsuranceHelperTypes as $value) {
                    if ($item->insurance_type == $value['value']) {
                        $type = $value['title'];
                    }
                }
                $insuranceTableData[] = [
                    'insuranceType' => $item->insurance_type_other != null ? $item->insurance_type_other : $type,
                    'insuranceCompany' => $item->insurance_company,
                    'tourpackageName' => $claim->tourpackage && $claim->tourpackage->name ? $claim->tourpackage->name : '',
                    'touristList' => $touristList
                ];
            }
        }
        // Услуга "Перелёт"
        $flightTableData = [];
        $serviceFlightHelperClass = ServiceHelper::flightClass();
        if (count($claim->serviceFlight) > 0) {
            $class = '';
            foreach ($claim->serviceFlight as $item) {
                foreach ($serviceFlightHelperClass as $value) {
                    if ($item->flight_class == $value['value']) {
                        $class = $value['title'];
                    }
                }
                $flightTableData[] = [
                    'flightFrom' => $item->flight_start,
                    'flightTo' => $item->flight_end,
                    'flightDateStart' => $item->dateflight_start ? $item->dateflight_start->format('d.m.Y H:i') : '',
                    'flightDateEnd' => $item->dateflight_end ? $item->dateflight_end->format('d.m.Y H:i') : '',
                    'flightClass' => $class,
                    'flightNumber' => $item->flight_number,
                    'touristList' => $touristList
                ];
            }
        }
        // Услуга "Трансфер"
        $transferTableData = [];
        $serviceTransferHelperType = ServiceHelper::transferType();
        if (count($claim->serviceTransfer) > 0) {
            foreach ($claim->serviceTransfer as $item) {
                $transferTableData[] = [
                    'transferName' => 'Трансфер',
                    'transferDescr' => $item->transfer_route_start . ',' . $item->transfer_route_end,
                ];
            }
        }
        // Услуга "Топливный сбор"
        $fuelSurchangeTableData = [];
        if (count($claim->serviceFuelSurchange) > 0) {
            foreach ($claim->serviceFuelSurchange as $item) {
                $fuelSurchangeTableData[] = [
                    'fuelsurchangeName' => 'Топливный сбор',
                    'fuelsurchangeDescr' => $item->fuelsurchange_name,
                ];
            }
        }
        // Другая услуга
        $otherServiceTableData = [];
        if (count($claim->serviceOther) > 0) {
            foreach ($claim->serviceOther as $item) {
                $otherServiceTableData[] = [
                    'otherServiceName' => 'Другая услуга',
                    'otherServiceDescr' => $item->other_service_name,
                ];
            }
        }
        // Данные об услуге "Виза"
        $visaTableData = [];
        $visaOptions = TouristHelper::visa();
        if (count($claim->tourist) > 0) {
            $isNeedVisa = '';
            foreach ($claim->tourist as $tourist) {
                if ($tourist->common) {
                    foreach ($visaOptions as $item) {
                        if ($tourist->common->visa_info == $item['value']) {
                            $isNeedVisa = $item['title'];
                        }
                    }
                }
                $visaTableData[] = [
                    'touristSurname' => $tourist->tourist_surname,
                    'touristName' => $tourist->tourist_name,
                    'touristPatronymic' => $tourist->tourist_patronymic,
                    'visaInfo' => $isNeedVisa
                ];
            }
        }
        // dd($visaTableData);
        // Данные о туристах
        $touristTableData = [];
        $genders = TouristHelper::gender();
        if (count($claim->tourist) > 0) {
            $genderStr = '';
            foreach ($claim->tourist as $tourist) {
                foreach ($genders as $genderItem) {
                    if ($tourist->common->tourist_gender == $genderItem['value']) {
                        $genderStr = $genderItem['title'];
                    }
                }
                $touristTableData[] = [
                    'touristSurname' => $tourist->tourist_surname,
                    'touristName' => $tourist->tourist_name,
                    'touristPatronymic' => $tourist->tourist_patronymic,
                    'touristSurnameLat' => $tourist->common && $tourist->common->tourist_surname_lat ? $tourist->common->tourist_surname_lat : '',
                    'touristNameLat' => $tourist->common && $tourist->common->tourist_name_lat ? $tourist->common->tourist_name_lat : '',
                    'touristGender' => $genderStr,
                    'touristBirthday' => $tourist->common && $tourist->common->tourist_birthday ? $tourist->common->tourist_birthday : '',
                    'touristPassportSeries' => $tourist->passport && $tourist->passport->tourist_passport_series ? $tourist->passport->tourist_passport_series : '',
                    'touristPassportNumber' => $tourist->passport && $tourist->passport->tourist_passport_number ? $tourist->passport->tourist_passport_number : '',
                    'touristPassportDate' => $tourist->passport && $tourist->passport->tourist_passport_date ? $tourist->passport->tourist_passport_date : '',
                    'touristInternationalPassportSeries' => $tourist->internationalPassport && $tourist->internationalPassport->tourist_international_passport_series
                        ? $tourist->internationalPassport->tourist_international_passport_series : '',
                    'touristInternationalPassportNumber' => $tourist->internationalPassport && $tourist->internationalPassport->tourist_international_passport_number
                        ? $tourist->internationalPassport->tourist_international_passport_number  : '',
                    'touristInternationalPassportDate' => $tourist->internationalPassport && $tourist->internationalPassport->tourist_international_passport_date
                        ? $tourist->internationalPassport->tourist_international_passport_date->format('d.m.Y') : '',
                    'touristInternationalPassportPeriod' => $tourist->internationalPassport && $tourist->internationalPassport->tourist_international_passport_period
                        ? $tourist->internationalPassport->tourist_international_passport_period->format('d.m.Y') : '',
                ];
            }
        }
        // dd($otherServiceTableData);
        // dd($contractData);
        $values = [
            ['userId' => 1, 'userName' => 'Batman', 'userAddress' => 'Gotham City'],
            ['userId' => 2, 'userName' => 'Superman', 'userAddress' => 'Metropolis'],
        ];
        $phpWord->cloneRowAndSetValues('userName', $values);

        $phpWord->cloneRowAndSetValues('excursionDescription', $excursionTableData);
        $phpWord->cloneRowAndSetValues('habitationHotel', $habitationTableData);
        $phpWord->cloneRowAndSetValues('insuranceCompany', $insuranceTableData);
        $phpWord->cloneRowAndSetValues('flightFrom', $flightTableData);
        $phpWord->cloneRowAndSetValues('transferName', $transferTableData);
        $phpWord->cloneRowAndSetValues('fuelsurchangeName', $fuelSurchangeTableData);
        $phpWord->cloneRowAndSetValues('otherServiceName', $otherServiceTableData);
        $phpWord->cloneRowAndSetValues('touristSurname', $touristTableData);
        $phpWord->cloneRowAndSetValues('visaInfo', $visaTableData);

        $phpWord->setValues($tourPackageTableData);

        $phpWord->setValues($contractData);
        $phpWord->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
