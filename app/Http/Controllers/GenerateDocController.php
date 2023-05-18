<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;

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

        $phpWord->setValues([
            'doc_type' => $docType,
        ]);
        $phpWord->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
