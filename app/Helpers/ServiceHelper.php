<?php

namespace App\Helpers;

class ServiceHelper
{
	static function flightClass()
	{
		$flightClasses = [
			['title' => "Неизвестно", 'value' => 'unknown'],
			['title' => "Эконом", 'value' => 'economy'],
			['title' => "Бизнес", 'value' => 'business'],
		];
		return $flightClasses;
	}
	static function insuranceType()
	{
		$insuranceTypes = [
			['title' => "Обязательное страхование медицинских расходов в период путешествия", 'value' => 'required'],
			['title' => "Расширенное страхование", 'value' => 'extended'],
			['title' => "Отмена поездки", 'value' => 'cancel'],
			['title' => "Другое (добавить вручную)", 'value' => 'other'],
		];
		return $insuranceTypes;
	}
	static function transferType()
	{
		$transferTypes = [
			['title' => "Групповой", 'value' => 'group'],
			['title' => "Индивидуальный", 'value' => 'individual'],
		];
		return $transferTypes;
	}
	static function habitationFoodType()
	{
		$habitationFoodTypes = [
			['title' => "RO", 'value' => 'RO'],
			['title' => "BB", 'value' => 'BB'],
			['title' => "HB", 'value' => 'HB'],
			['title' => "FB", 'value' => 'FB'],
			['title' => "AI", 'value' => 'AI'],
			['title' => "UAI", 'value' => 'UAI'],
		];
		return $habitationFoodTypes;
	}
}
