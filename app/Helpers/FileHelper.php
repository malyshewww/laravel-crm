<?php

namespace App\Helpers;

class FileHelper
{
	static function fileType()
	{
		$fileTypes = [
			['title' => "Документ туриста", 'value' => 'doc_tourist'],
			['title' => "Платежный документ", 'value' => 'doc_payment'],
			['title' => "Документ тура", 'value' => 'doc_tour'],
		];
		return $fileTypes;
	}
}
