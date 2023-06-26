<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Helpers\FinanceHelper;
use App\Helpers\ServiceHelper;
use App\Helpers\TouristHelper;
use Illuminate\Http\Request;

class SelectDataController extends Controller
{
    public function dataHelper()
    {
        $currencies = FinanceHelper::currency();
        $calculations = FinanceHelper::calculation();

        $genders = TouristHelper::gender();
        $nationalities = TouristHelper::nationality();
        $visaOptions = TouristHelper::visa();
        $cities = TouristHelper::city();

        $flightClasses = ServiceHelper::flightClass();
        $insuranceTypes = ServiceHelper::insuranceType();
        $transferTypes = ServiceHelper::transferType();
        $habitationFoodTypes = ServiceHelper::habitationFoodType();

        $fileTypes = FileHelper::fileType();
        return response()->json([
            'genders' => $genders,
            'nationalities' => $nationalities,
            'visaOptions' => $visaOptions,
            'cities' => $cities,
            'flightClasses' => $flightClasses,
            'insuranceTypes' => $insuranceTypes,
            'transferTypes' => $transferTypes,
            'habitationFoodTypes' => $habitationFoodTypes,
            'fileTypes' => $fileTypes,
            'currencies' => $currencies,
            'calculations' => $calculations,
        ]);
    }
}
