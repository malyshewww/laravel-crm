<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = $this->validate($request, [
        //     'fname' => 'required',
        //     'lname' => 'required',
        //     'address' => 'required',
        //     'mobile' => 'required',
        // ]);
        // dd($validator);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 'error',
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => 'success',
        //     ]);
        // }
        // dd($validator);
        // if ($validator->fails()) { // Проверка на наличия ошибок валидации
        //     $request->flash(); // Сохранение в сессию данных полей формы
        //     // return response(view('employee.index')->withErrors($validator)->render(), 422); // ответ сервера, рендерится view - НTML формы с ошибками валидации, со статусом ответа 422
        //     return response()->json([
        //         'status' => 'error',
        //         'errors' => ($validator->getMessageBag()->toArray())
        //     ]);
        // } else {
        //     // return response()->json([
        //         //     'status' => 'success'
        //         // ], 200);
        //     }
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'address' => 'required',
            'mobile' => 'required',
        ], [
            'fname.required' => "Поле firstname обязательно для заполнения",
            'lname.required' => "Поле lastname обязательно для заполнения",
            'address.required' => "Поле address обязательно для заполнения",
            'mobile.required' => "Поле mobile обязательно для заполнения",
        ]);
        $emps = new Employee;
        $emps->fname = $request->fname;
        $emps->lname = $request->lname;
        $emps->address = $request->address;
        $emps->mobile = $request->mobile;
        $emps->id = $request->id;
        // dd($validator);
        $emps->save();

        return redirect()->to('employee/' . $emps->id);
        // return redirect('/employee')->with('success', 'data saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $emp, $id)
    {
        $emp = Employee::find($id);
        return view('employee.show', compact('emp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $emp = Employee::find($id);
        Employee::find($id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
        // $emp->delete();
        // return redirect()->route('employee.index');
    }
}
