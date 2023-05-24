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
use App\Http\Controllers\FileController;
use App\Http\Controllers\FinancePaymentController;
use App\Http\Controllers\FinancePaymentInvoiceController;
use App\Http\Controllers\FinancePrepaymentController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\FuelSurchangeController;
use App\Http\Controllers\GenerateDocController;
use App\Http\Controllers\HabitationController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\OtherServiceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TouristController;
use App\Http\Controllers\TourOperatorController;
use App\Http\Controllers\TourPackageController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\VisaController;
use App\Models\FinancePrepayment;
use Illuminate\Support\Facades\Artisan;

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
Route::get('/claims', [ClaimController::class, 'index'])->middleware('auth')->name('claim.index');
Route::get('/claims/create/{id}', [ClaimController::class, 'create'])->name('claim.create');
Route::get('/claims/{claim}', [ClaimController::class, 'show'])->middleware('auth')->name('claim.show');
Route::post('/claims', [ClaimController::class, 'store'])->name('claim.store');
Route::patch('/claims/{claim}', [ClaimController::class, 'update'])->name('claim.update');
Route::delete('/claims/{claim}', [ClaimController::class, 'destroy'])->name('claim.destroy');
Route::post('/claims/records', [ClaimController::class, 'records'])->name('claim.records');

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
Route::delete('/tourists/{tourist}/delete', [TouristController::class, 'destroy'])->name('tourist.destroy');
Route::get('/tourists/{tourist}/data', [TouristController::class, 'touristData'])->name('tourist.data');
// Данные об услугах

// Услуга Перелет
Route::post('/flights', [FlightController::class, 'store'])->name('flight.store');
Route::patch('/flights/update', [FlightController::class, 'update'])->name('flight.update');
Route::delete('/flights/{flight}/delete', [FlightController::class, 'destroy'])->name('flight.destroy');

// Услуга Страховка
Route::post('/insurances', [InsuranceController::class, 'store'])->name('insurance.store');
Route::patch('/insurances/update', [InsuranceController::class, 'update'])->name('insurance.update');
Route::delete('/insurances/{insurance}/delete', [InsuranceController::class, 'destroy'])->name('insurance.destroy');

// Услуга Трансфер
Route::post('/transfers', [TransferController::class, 'store'])->name('transfer.store');
Route::patch('/transfers/update', [TransferController::class, 'update'])->name('transfer.update');
Route::delete('/transfers/{transfer}/delete', [TransferController::class, 'destroy'])->name('transfer.destroy');

// Услуга виза
Route::post('/visas', [VisaController::class, 'store'])->name('visa.store');
Route::patch('/visas/update', [VisaController::class, 'update'])->name('visa.update');
Route::delete('/visas/{visa}/delete', [VisaController::class, 'destroy'])->name('visa.destroy');

// Услуга Проживание
Route::post('/habitations', [HabitationController::class, 'store'])->name('habitation.store');
Route::patch('/habitations/update', [HabitationController::class, 'update'])->name('habitation.update');
Route::delete('/habitations/{habitation}/delete', [HabitationController::class, 'destroy'])->name('habitation.destroy');

// Услуга Топливный сбор
Route::post('/fuelsurchanges', [FuelSurchangeController::class, 'store'])->name('fuelsurchange.store');
Route::patch('/fuelsurchanges/update', [FuelSurchangeController::class, 'update'])->name('fuelsurchange.update');
Route::delete('/fuelsurchanges/{fuelsurchange}/delete', [FuelSurchangeController::class, 'destroy'])->name('fuelsurchange.destroy');

// Услуга Экскурсионная программа
Route::post('/excursions', [ExcursionController::class, 'store'])->name('excursion.store');
Route::patch('/excursions/update', [ExcursionController::class, 'update'])->name('excursion.update');
Route::delete('/excursions/{excursion}/delete', [ExcursionController::class, 'destroy'])->name('excursion.destroy');

// Услуга  "Другая услуга"
Route::post('/otherservices', [OtherServiceController::class, 'store'])->name('otherservice.store');
Route::patch('/otherservices/update', [OtherServiceController::class, 'update'])->name('otherservice.update');
Route::delete('/otherservices/{otherservice}/delete', [OtherServiceController::class, 'destroy'])->name('otherservice.destroy');

// Добавление/Удаление файлов
Route::post('/files', [FileController::class, 'store'])->name('file.store');
Route::delete('/files/{file}/delete', [FileController::class, 'destroy'])->name('file.destroy');

// Финансы
// Параметры предоплаты
Route::post('/prepayments', [FinancePrepaymentController::class, 'store'])->name('prepayment.store');

// Параметры стоимости
Route::post('/payments', [FinancePaymentController::class, 'store'])->name('payment.store');

// Выставление счета туристу
Route::post('/payment_invoices', [FinancePaymentInvoiceController::class, 'store'])->name('payment_invoice.store');
Route::patch('/payment_invoices/update', [FinancePaymentInvoiceController::class, 'update'])->name('payment_invoice.update');
Route::delete('/payment_invoices/{payment_invoice}/delete', [FinancePaymentInvoiceController::class, 'destroy'])->name('payment_invoice.destroy');

// Формирование договора
Route::post('/docs', [GenerateDocController::class, 'docExport'])->name('docExport');

// Сотрудники
Route::get('/employee', 'EmployeeController@index')->name('employee.index');
Route::get('/employee/{employee}', [EmployeeController::class, 'show'])->name('employee.show');
Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::delete('/employee/{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

// Storage:link
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

// Авторизация
// Route::name('user.')->group(function () {
Route::view('/private', 'private')->middleware('auth')->name('private');
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect(route('claim.index'));
    }
    return view('login');
})->name('user.login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/registration', function () {
    if (Auth::check()) {
        return redirect(route('claim.index'));
    }
    return view('registration');
})->name('user.registration');

Route::post('/registration', [RegisterController::class, 'save'])->name('registration');
// });
