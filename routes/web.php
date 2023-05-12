<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExcursionController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\FuelSurchangeController;
use App\Http\Controllers\HabitationController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\OtherServiceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TouristController;
use App\Http\Controllers\TourOperatorController;
use App\Http\Controllers\TourPackageController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\VisaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('registration');
});

// Заявка
Route::get('/claims', [ClaimController::class, 'index'])->name('claim.index');
Route::get('/claims/create/{id}', [ClaimController::class, 'create'])->name('claim.create');
Route::get('/claims/{claim}', [ClaimController::class, 'show'])->name('claim.show');
Route::post('/claims', [ClaimController::class, 'store'])->name('claim.store');
Route::patch('/claims/{claim}', [ClaimController::class, 'update'])->name('claim.update');
Route::delete('/claims/{claim}', [ClaimController::class, 'destroy'])->name('claim.destroy');

// Route::get('/comment/{id}', [ClaimController::class, 'get_comment'])->name('data');
// Route::get('/claims/{claim}', [ClaimController::class, 'data'])->name('claim.data');

// Информация о туроператоре
Route::post('/touroperators', [TourOperatorController::class, 'store'])->name('touroperator.store');

// Информация о турпакете
Route::post('/tourpackages', [TourPackageController::class, 'store'])->name('tourpackage.store');

// Данные договора и бронироваиня (добавить ajax в скрипте)
Route::post('/contracts/{contract}', [ContractController::class, 'store'])->name('contract.store');

// Данные о заказчике (Физическое|Юридическое лицо)
Route::get('/customers/{customer}', [CustomerController::class, 'customerData'])->name('customer.customerData');
Route::post('/customers/{customer}', [CustomerController::class, 'store'])->name('customer.store');

// Данные о туристе
Route::post('/tourists/{tourist}', [TouristController::class, 'store'])->name('tourist.store');
Route::patch('/tourists/update/{tourist}', [TouristController::class, 'update'])->name('tourist.update');

// Данные об услугах

// Услуга Перелет
Route::post('/flights', [FlightController::class, 'store'])->name('flight.store');
Route::patch('/flights/update', [FlightController::class, 'update'])->name('flight.update');

// Услуга Страховка
Route::post('/insurances', [InsuranceController::class, 'store'])->name('insurance.store');
Route::patch('/insurances/update', [InsuranceController::class, 'update'])->name('insurance.update');

// Услуга Трансфер
Route::post('/transfers', [TransferController::class, 'store'])->name('transfer.store');
Route::patch('/transfers/update', [TransferController::class, 'update'])->name('transfer.update');

// Услуга виза
Route::post('/visas', [VisaController::class, 'store'])->name('visa.store');
Route::patch('/visas/update', [VisaController::class, 'update'])->name('visa.update');

// Услуга Проживание
Route::post('/habitations', [HabitationController::class, 'store'])->name('habitation.store');
Route::patch('/habitations/update', [HabitationController::class, 'update'])->name('habitation.update');

// Услуга Топливный сбор
Route::post('/fuelsurchanges', [FuelSurchangeController::class, 'store'])->name('fuelsurchange.store');
Route::patch('/fuelsurchanges/update', [FuelSurchangeController::class, 'update'])->name('fuelsurchange.update');

// Услуга Экскурсионная программа
Route::post('/excursions', [ExcursionController::class, 'store'])->name('excursion.store');
Route::patch('/excursions/update', [ExcursionController::class, 'update'])->name('excursion.update');

// Услуга  "Другая услуга"
Route::post('/otherservices', [OtherServiceController::class, 'store'])->name('otherservice.store');
Route::patch('/otherservices/update', [OtherServiceController::class, 'update'])->name('otherservice.update');

// Сотрудники
Route::get('/employee', 'EmployeeController@index')->name('employee.index');
Route::get('/employee/{employee}', [EmployeeController::class, 'show'])->name('employee.show');
Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::delete('/employee/{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy');



// Авторизация
Route::name('user.')->group(function () {
    Route::view('/private', 'private')->middleware('auth')->name('private');
    Route::get('/login', function () {
        if (Auth::check()) {
            return redirect(route('user.private'));
        }
        return view('login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');


    Route::get('/registration', function () {
        if (Auth::check()) {
            return redirect(route('user.private'));
        }
        return view('registration');
    })->name('registration');

    Route::post('/registration', [RegisterController::class, 'save']);
});
