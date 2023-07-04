<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function personData($id, $action)
    {
        if ($action === 'old') {
            $person = Person::findOrFail($id);
            return view('claim.customer.modal_customer_person', compact('person'))->render();
        } else {
            return view('claim.customer.modal_customer_person_new')->render();
        }
    }
}
