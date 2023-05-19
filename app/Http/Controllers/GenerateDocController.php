<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;
// use PhpOffice\PhpWord\PhpWord;
// use PhpOffice\PhpWord\Writer\Word2007;

class GenerateDocController extends Controller
{
    public function docExport(Request $request)
    {
        $contractData = [];
        $docType = $request->doc_type;
        $claimId = $request->id;
        $claim = Claim::find($claimId);
        $contractData['claimId'] = $claim->id;
        $contractData['claimDate'] = $claim->date_start->format('d.m.Y');
        if ($claim->customer && $claim->customer->type === 'person') {
            if ($claim->customer->person) {
                $contractData['personSurname'] = $claim->customer->person->person_surname ?: 'Фамилия';
                $contractData['personName'] = $claim->customer->person->person_name ?: 'Имя';
                $contractData['personPatronymic'] = $claim->customer->person->person_patronymic ?: 'Отчество';
                $contractData['personPassportSeries'] = $claim->customer->person->passport->person_passport_series ?: '-';
                $contractData['personPassportNumber'] = $claim->customer->person->passport->person_passport_number ?: '-';
                $contractData['personPassportIssued'] = $claim->customer->person->passport->person_passport_issued ?: '-';
                $contractData['personPassportDate'] = $claim->customer->person->passport->person_passport_date ?: '-';
                $contractData['personPassportAddress'] = $claim->customer->person->passport->person_passport_address ?: '-';
                $contractData['personAddress'] = $claim->customer->person->commons->person_address ?: '-';
                $contractData['personPhone'] = $claim->customer->person->commons->person_phone ?: '-';
                $contractData['personEmail'] = $claim->customer->person->commons->person_email ?: '-';
            }
        }
        // dd($contractData);
        // Creating the new document...
        $fileName = '';
        if ($docType == 'doc_avia') {
            $fileName = 'contract_avia';
        } else if ($docType == 'doc_bus') {
            $fileName = 'contract_bus';
        }
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('contracts/' . $fileName . '.docx');
        $phpWord->setValues($contractData);
        $phpWord->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
