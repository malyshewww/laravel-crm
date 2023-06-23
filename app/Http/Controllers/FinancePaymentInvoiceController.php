<?php

namespace App\Http\Controllers;

use App\Models\FinancePaymentInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancePaymentInvoiceController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'calculate' => $request->calculate,
            'sum' => $request->sum,
            'currency' => $request->currency,
            'date_invoices' => $request->date_invoices,
            'claim_id' => $request->claim_id
        ];
        FinancePaymentInvoice::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function update(Request $request)
    {
        $data = [
            'calculate' => $request->calculate,
            'sum' => $request->sum,
            'currency' => $request->currency,
            'date_invoices' => $request->date_invoices,
            'claim_id' => $request->claim_id
        ];
        FinancePaymentInvoice::updateOrCreate([
            'id' => $request->record_id
        ], $data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function destroy($id)
    {
        FinancePaymentInvoice::where('id', $id)->forceDelete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function loadModal($id, $action)
    {
        $itemInvoice = FinancePaymentInvoice::findOrFail($id);
        return view('claim.finance.modals.modal_update_invoice', compact('itemInvoice'))->render();
    }
}
