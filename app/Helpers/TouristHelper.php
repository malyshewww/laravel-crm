<?php

namespace App\Helpers;

class TouristHelper extends TourPackageHelper
{
	static function visa()
	{
		$visaOptions = [
			['value' => 'not', 'title' => 'Не требуется'],
			['value' => 'yes', 'title' => 'Надо оформить визу'],
		];
		return $visaOptions;
	}
	static function gender()
	{
		$genders = [
			['title' => "Мужской", 'value' => 'male'],
			['title' => "Женский", 'value' => 'female'],
		];
		return $genders;
	}
	static function nationality()
	{
		$nationalities = [
			['title' => "Россия", 'value' => 'Russia'],
			['title' => "Беларусь", 'value' => 'Belarus'],
			['title' => "Украина", 'value' => 'Ukraine'],
		];
		return $nationalities;
	}
}
