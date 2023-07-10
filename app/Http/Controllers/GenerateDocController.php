<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;
use App\Helpers\ServiceHelper;
use App\Helpers\TouristHelper;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class GenerateDocController extends Controller
{
    public function docExport(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'doc_type' => 'required',
        // ]);
        // $json = [];
        // $errors = $validator->errors();
        // if ($validator->fails()) {
        //     $json['status'] = 'error';
        //     foreach ($errors->getMessages() as $key => $message) {
        //         $json[$key] = 'error';
        //     }
        //     return response()->json($json);
        // }
        $docType = $request->doc_type;
        // Creating the new document...
        $fileName = '';
        switch ($docType) {
            case 'doc_avia':
                $fileName = 'contract_avia';
                break;
            case 'doc_bus':
                $fileName = 'contract_bus';
                break;
            case '':
                $fileName = 'contract_avia';
            default:
                break;
        }
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('contracts/' . $fileName . '.docx');
        $phpOfficeWord = new \PhpOffice\PhpWord\PhpWord();
        $contractData = [];
        $claimId = $request->id;
        $claim = Claim::find($claimId);
        $claimId = $claim->id . '-' . date('Y');
        $claimDate = $claim->date_start->format('d.m.Y');
        $phpWord->setValue('claimId', $claimId);
        $phpWord->setValue('claimDate', $claimDate);
        // Общие данные по заявке, когда заказчик - ФИЗ. ЛИЦО
        $personSurname = '';
        $personName = '';
        $personPatronymic = '';
        $personPassportSeries = '';
        $personPassportNumber = '';
        $personPassportIssued = '';
        $personPassportDate = '';
        $personPassportAddress = '';
        $personAddress = '';
        $personPhone = '';
        $personEmail = '';
        if ($claim->customer && $claim->customer->type === 'person') {
            if ($claim->person) {
                $personSurname = $claim->person->person_surname ?: 'Фамилия';
                $personName = $claim->person->person_name ?: 'Имя';
                $personPatronymic = $claim->person->person_patronymic ?: 'Отчество';
                $personPassportSeries = $claim->person->person_passport_series ?: '-';
                $personPassportNumber = $claim->person->person_passport_number ?: '-';
                $personPassportIssued = $claim->person->person_passport_issued ?: '-';
                $personPassportDate = $claim->person->person_passport_date ?: '-';
                $personPassportAddress = $claim->person->person_passport_address ?: '-';
                $personAddress = $claim->person->person_address ?: '-';
                $personPhone = $claim->person->person_phone ?: '-';
                $personEmail = $claim->person->person_email ?: '-';
            }
        }
        $phpWord->setValue('personSurname', $personSurname);
        $phpWord->setValue('personName', $personName);
        $phpWord->setValue('personPatronymic', $personPatronymic);
        $phpWord->setValue('personPassportSeries', $personPassportSeries);
        $phpWord->setValue('personPassportNumber', $personPassportNumber);
        $phpWord->setValue('personPassportIssued', $personPassportIssued);
        $phpWord->setValue('personPassportDate', $personPassportDate);
        $phpWord->setValue('personPassportAddress', $personPassportAddress);
        $phpWord->setValue('personAddress', $personAddress);
        $phpWord->setValue('personPhone', $personPhone);
        $phpWord->setValue('personEmail', $personEmail);
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
            $tourPackageTableData[] = [
                'tourpackageName' => $claim->tourpackage->name,
                'claimDateStart' => $claim->date_start->format('d.m.Y'),
                'claimDateEnd' => $claim->date_end->format('d.m.Y')
            ];
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
        if (count($claim->tourist) > 0) {
            $visaOptions = TouristHelper::visa();
            $isNeedVisa = '';
            foreach ($claim->tourist as $tourist) {
                if ($tourist->common) {
                    foreach ($visaOptions as $item) {
                        if ($tourist->common->visa_info === $item['value']) {
                            $isNeedVisa = $item['title'];
                        }
                    }
                }
                $visaTableData[] = [
                    'touristSurname' => $tourist->tourist_surname ?: '',
                    'touristName' => $tourist->tourist_name ?: '',
                    'touristPatronymic' => $tourist->tourist_patronymic ?: '',
                    'visaInfo' => $isNeedVisa ?: ''
                ];
            }
        }
        // Услуга "Трансфер"
        $transferTableData = [];
        $transferTypes = ServiceHelper::transferType();
        if (count($claim->serviceTransfer) > 0) {
            $transferTypeStr = '';
            foreach ($claim->serviceTransfer as $key => $item) {
                foreach ($transferTypes as $transferType) {
                    if ($transferType['value'] == $item->transfer_type) {
                        $transferTypeStr = $transferType['title'];
                    }
                }
                $transferTableData[] = [
                    'transferId' => $key + 1,
                    'transferRoute' => $item->transfer_route ?: '',
                    'transferType' => $transferTypeStr ?: '',
                    'transferTransport' => $item->transfer_transport ?: '',
                    'touristList' => $touristList ?: '',
                ];
            }
        }
        // Данные о туристах
        $touristTableData = [];
        $genders = TouristHelper::gender();
        if (count($claim->tourist) > 0) {
            $genderStr = '';
            foreach ($claim->tourist as $tourist) {
                if ($tourist->common) {
                    foreach ($genders as $genderItem) {
                        if ($tourist->common->tourist_gender === $genderItem['value']) {
                            $genderStr = $genderItem['title'];
                        }
                    }
                }
                $touristTableData[] = [
                    'id' => $tourist->id ?: '',
                    'touristSurname' => $tourist->tourist_surname ?: '',
                    'touristName' => $tourist->tourist_name ?: '',
                    'touristPatronymic' => $tourist->tourist_patronymic ?: '',
                    'touristSurnameLat' => $tourist->common && $tourist->common->tourist_surname_lat ? $tourist->common->tourist_surname_lat : '',
                    'touristNameLat' => $tourist->common && $tourist->common->tourist_name_lat ? $tourist->common->tourist_name_lat : '',
                    'touristGender' => $genderStr,
                    'touristBirthday' => $tourist->common && $tourist->common->tourist_birthday ? $tourist->common->tourist_birthday : '',
                    'touristPassportSeries' => $tourist->passport && $tourist->passport->tourist_passport_series
                        ? $tourist->passport->tourist_passport_series : '',
                    'touristPassportNumber' => $tourist->passport && $tourist->passport->tourist_passport_number
                        ? $tourist->passport->tourist_passport_number : '',
                    'touristPassportDate' => $tourist->passport && $tourist->passport->tourist_passport_date
                        ? $tourist->passport->tourist_passport_date : '',
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
        if ($docType == 'doc_avia') {
            $phpWord->cloneRowAndSetValues('excursionDescription', $excursionTableData);
            $phpWord->cloneRowAndSetValues('habitationHotel', $habitationTableData);
            $phpWord->cloneRowAndSetValues('insuranceCompany', $insuranceTableData);
            $phpWord->cloneRowAndSetValues('flightFrom', $flightTableData);
            $phpWord->cloneRowAndSetValues('fuelsurchangeName', $fuelSurchangeTableData);
            $phpWord->cloneRowAndSetValues('otherServiceName', $otherServiceTableData);
            $phpWord->cloneRowAndSetValues('touristSurname', $touristTableData);
            $phpWord->cloneRowAndSetValues('visaInfo', $visaTableData);
            $phpWord->cloneRowAndSetValues('touristList', $transferTableData);
            $phpWord->cloneRowAndSetValues('tourpackageName', $tourPackageTableData);
        }

        function number2string($number)
        {
            // обозначаем словарь в виде статической переменной функции, чтобы 
            // при повторном использовании функции его не определять заново
            static $dic = array(
                // словарь необходимых чисел
                array(
                    -2    => 'две',
                    -1    => 'одна',
                    1    => 'один',
                    2    => 'два',
                    3    => 'три',
                    4    => 'четыре',
                    5    => 'пять',
                    6    => 'шесть',
                    7    => 'семь',
                    8    => 'восемь',
                    9    => 'девять',
                    10    => 'десять',
                    11    => 'одиннадцать',
                    12    => 'двенадцать',
                    13    => 'тринадцать',
                    14    => 'четырнадцать',
                    15    => 'пятнадцать',
                    16    => 'шестнадцать',
                    17    => 'семнадцать',
                    18    => 'восемнадцать',
                    19    => 'девятнадцать',
                    20    => 'двадцать',
                    30    => 'тридцать',
                    40    => 'сорок',
                    50    => 'пятьдесят',
                    60    => 'шестьдесят',
                    70    => 'семьдесят',
                    80    => 'восемьдесят',
                    90    => 'девяносто',
                    100    => 'сто',
                    200    => 'двести',
                    300    => 'триста',
                    400    => 'четыреста',
                    500    => 'пятьсот',
                    600    => 'шестьсот',
                    700    => 'семьсот',
                    800    => 'восемьсот',
                    900    => 'девятьсот'
                ),
                // словарь порядков со склонениями для плюрализации
                array(
                    array('рубль', 'рубля', 'рублей'),
                    array('тысяча', 'тысячи', 'тысяч'),
                    array('миллион', 'миллиона', 'миллионов'),
                    array('миллиард', 'миллиарда', 'миллиардов'),
                    array('триллион', 'триллиона', 'триллионов'),
                    array('квадриллион', 'квадриллиона', 'квадриллионов'),
                    // квинтиллион, секстиллион и т.д.
                ),
                // карта плюрализации
                array(
                    2, 0, 1, 1, 1, 2
                )
            );
            $unit = array(
                array('копейка', 'копейки', 'копеек', 1),
            );
            $ten = array(
                array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
                array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять')
            );
            $a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
            $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
            // обозначаем переменную в которую будем писать сгенерированный текст
            $resultSum = '';
            $string = array();
            $stringCopecks = array();
            // дополняем число нулями слева до количества цифр кратного трем,
            // например 1234, преобразуется в 001234
            $number = str_pad($number, ceil(strlen($number) / 3) * 3, 0, STR_PAD_LEFT);
            list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($number)));
            // разбиваем число на части из 3 цифр (порядки) и инвертируем порядок частей,
            // т.к. мы не знаем максимальный порядок числа и будем бежать снизу
            // единицы, тысячи, миллионы и т.д.
            $parts = array_reverse(str_split($rub, 3));
            $copecksParts = array_reverse(str_split($kop, 3));
            $separator = '';
            // бежим по каждой части
            foreach ($parts as $i => $part) {
                // если часть не равна нулю, нам надо преобразовать ее в текст
                if ($part > 0) {
                    // обозначаем переменную в которую будем писать составные числа для текущей части
                    $digits = array();
                    // если число треххзначное, запоминаем количество сотен
                    if ($part > 99) {
                        $digits[] = floor($part / 100) * 100;
                    }
                    // если последние 2 цифры не равны нулю, продолжаем искать составные числа
                    // (данный блок прокомментирую при необходимости)
                    if ($mod1 = $part % 100) {
                        $mod2 = $part % 10;
                        $flag = $i == 1 && $mod1 != 11 && $mod1 != 12 && $mod2 < 3 ? -1 : 1;
                        if ($mod1 < 20 || !$mod2) {
                            $digits[] = $flag * $mod1;
                        } else {
                            $digits[] = floor($mod1 / 10) * 10;
                            $digits[] = $flag * $mod2;
                        }
                    }
                    // берем последнее составное число, для плюрализации
                    $last = abs(end($digits));
                    // преобразуем все составные числа в слова
                    foreach ($digits as $j => $digit) {
                        $digits[$j] = $dic[0][$digit];
                    }
                    // добавляем обозначение порядка или валюту
                    $digits[] = $dic[1][$i][(($last %= 100) > 4 && $last < 20) ? 2 : $dic[2][min($last % 10, 5)]];

                    // объединяем составные числа в единый текст и добавляем в переменную, которую вернет функция
                    array_unshift($string, join(' ', $digits));
                }
            }
            foreach ($copecksParts as $uk => $part) {
                // если часть не равна нулю, нам надо преобразовать ее в текст
                if ($part > 0) {
                    // обозначаем переменную в которую будем писать составные числа для текущей части
                    $out = array();
                    $uk = sizeof($unit) - $uk - 1;
                    $gender = $unit[$uk][3];
                    list($i2, $i3) = array_map('intval', str_split($part, 1));
                    // mega-logic
                    if ($i2 > 1) {
                        $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; // 20-99
                    } else {
                        $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; // 10-19 | 1-9
                    }
                    if ($uk > 1) $out[] = morph($part, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
                    // добавляем обозначение порядка или валюту
                    $out[] = morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]);
                    // объединяем составные числа в единый текст и добавляем в переменную, которую вернет функция
                    array_push($stringCopecks, join(' ', $out));
                }
            }

            // преобразуем переменную в текст и возвращаем из функции!
            $resultSum = join(' ', $string) . $separator . join(' ', $stringCopecks);
            return $resultSum;
        }
        /**
         * Склоняем словоформу
         * @author runcore
         */
        function morph($n, $f1, $f2, $f5)
        {
            $n = abs(intval($n)) % 100;
            if ($n > 10 && $n < 20) return $f5;
            $n = $n % 10;
            if ($n > 1 && $n < 5) return $f2;
            if ($n == 1) return $f1;
            return $f5;
        }
        function num2str($num)
        {
            $nul = 'ноль';
            $ten = array(
                array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
                array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять')
            );
            $a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
            $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
            $hundred = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
            $unit = array(
                array('копейка', 'копейки',   'копеек',     1),
                array('рубль',    'рубля',     'рублей',     0),
                array('тысяча',   'тысячи',    'тысяч',      1),
                array('миллион',  'миллиона',  'миллионов',  0),
                array('миллиард', 'миллиарда', 'миллиардов', 0),
            );

            list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
            $out = array();
            $kopArray = array();
            $str = array();
            if (intval($rub) > 0) {
                foreach (str_split($rub, 3) as $uk => $v) {
                    if (!intval($v)) continue;
                    $uk = sizeof($unit) - $uk - 1;
                    $gender = $unit[$uk][3];
                    list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
                    // mega-logic
                    $out[] = $hundred[$i1]; // 1xx-9xx
                    if ($i2 > 1) $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; // 20-99
                    else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; // 10-19 | 1-9
                    // units without rub & kop
                    if ($uk > 1) $out[] = morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
                }
            } else {
                $out[] = $nul;
            }
            if (intval($kop) > 0) {
                foreach (str_split($kop, 3) as $uk => $v) {
                    $uk = sizeof($unit) - $uk - 1;
                    $gender = $unit[$uk][3];
                    list($i2, $i3) = array_map('intval', str_split($v, 1));
                    // mega-logic
                    if ($i2 > 1) {
                        $kopArray[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; // 20-99
                    } else {
                        $kopArray[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; // 10-19 | 1-9
                    }
                    // добавляем обозначение порядка или валюту
                    $kopArray[] = morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]);
                    // объединяем составные числа в единый текст и добавляем в переменную, которую вернет функция
                    array_push($str, join(' ', $kopArray));
                }
            } else {
                $kopArray[] = $nul;
            }
            $res = join(' ', $str);
            $out[] = morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
            // $out[] = $kop . ' ' . morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
            return trim(preg_replace('/ {2,}/', ' ', join(' ', $out))) . ' ' . $res;
        }
        $resultSumRUB = '';
        if (count($claim->paymentInvoices) > 0) {
            $currencyRUB = [];
            foreach ($claim->paymentInvoices as $key => $item) {
                if ($item->currency === 'RUB') {
                    $currencyRUB[] = $item->sum;
                }
            }
            $resultSumRUB = array_sum($currencyRUB);
        }
        $num = abs($resultSumRUB);
        $int_part = number_format(intval($num), 0, ' ', ' ');
        $dec_part = $num * 100 % 100;
        $strPriceNumber = $int_part . ' руб.' . ', ' . $dec_part . ' коп.';
        $strPriceWord = num2str($resultSumRUB);
        $phpWord->setValue('priceNumber', $strPriceNumber);
        $phpWord->setValue('priceWord', $strPriceWord);
        // $wordPdf = \PhpOffice\PhpWord\IOFactory::load($fileName . ".docx");
        // $pdfWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordPdf, 'PDF');
        // $pdfWriter->save($fileName . ".pdf");
        $phpWord->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
