<?php

namespace App\Helpers;

class DocsHelper
{
	static function status()
	{
		$arrStatus = [
			['title' => "Не отправлены", 'value' => 'no_send'],
			['title' => "Отправлены частично", 'value' => 'send_part'],
			['title' => "Отправлены", 'value' => 'send_full'],
		];
		return $arrStatus;
	}
}
