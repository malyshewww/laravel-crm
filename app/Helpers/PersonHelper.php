<?php

namespace App\Helpers;

class PersonHelper
{
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
