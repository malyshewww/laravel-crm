<?php

namespace App\Helpers;

class CustomerHelper
{
	static function customer()
	{
		$customers = [
			['title' => "Физическое лицо", 'type' => 'person'],
			['title' => "Юридическое лицо", 'type' => 'company'],
		];
		return $customers;
	}
}
