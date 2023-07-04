<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
	public function companyData($id, $action)
	{
		if ($action === 'old') {
			$company = Company::findOrFail($id);
			return view('claim.customer.modal_customer_company', compact('company'))->render();
		} else {
			return view('claim.customer.modal_customer_company_new')->render();
		}
	}
}
