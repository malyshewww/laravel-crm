<?php

namespace App\Helpers;

class FinanceHelper
{
	static function currency()
	{
		$currencies = [
			['title' => "RUB", 'value' => 'RUB'],
			['title' => "USD", 'value' => 'USD'],
			['title' => "EUR", 'value' => 'EUR'],
		];
		return $currencies;
	}
	static function calculation()
	{
		$calculations = [
			['title' => "Наличный", 'value' => 'cash'],
			['title' => "Безналичный", 'value' => 'noncash'],
		];
		return $calculations;
	}
}
