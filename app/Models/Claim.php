<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Claim extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'claims';
    protected $casts = [
        'date_start' => 'date:d.m.Y', // Свой формат
        'date_end' => 'date:d.m.Y',
        'created_at' => 'date:d.m.Y',
    ];
    protected $dates = ['date_start', 'date_end', 'created_at'];
    protected $fillable = ['date_start', 'date_end', 'comment', 'manager'];
    public function getIdProductAttribute($value)
    {
        return encrypt($value);
    }
    public function setIdProductAttribute($value)
    {
        $this->attributes['id'] = decrypt($value);
    }
    // protected $dateFormat = 'd.m.Y';
    // public function setDateStartAttribute($value)
    // {
    //     $this->attributes['date_start'] = (new Carbon($value))->format('d.m.Y');
    // }
    // public function setDateEndAttribute($value)
    // {
    //     $this->attributes['date_end'] = (new Carbon($value))->format('d.m.Y');
    // }
    public function person()
    {
        return $this->hasOne(Person::class);
    }
    public function company()
    {
        return $this->hasOne(Company::class);
    }
    public function latestClaim()
    {
        return $this->hasOne(Claim::class)->latest();
    }
    function getFullNameAttribute()
    {
        return $this->attributes['date_start'];
    }
    // Данные туроператора
    public function touroperator()
    {
        return $this->hasOne(Touroperator::class);
    }
    // Данные турпакета
    public function tourpackage()
    {
        return $this->hasOne(TourPackage::class);
    }
    // Данные договора
    public function contract()
    {
        return $this->hasOne(Contract::class);
    }
    // Заказчик
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
    // Туристы
    public function tourist()
    {
        return $this->hasMany(Tourist::class);
    }
    public function service()
    {
        return $this->hasMany(Service::class);
    }
    // УСЛУГИ
    // Услуга - Перелёт
    public function serviceFlight()
    {
        return $this->hasMany(Flight::class);
    }
    // Услуга - Страховка
    public function serviceInsurance()
    {
        return $this->hasMany(Insurance::class);
    }
    // Услуга - Трансфер
    public function serviceTransfer()
    {
        return $this->hasMany(Transfer::class);
    }
    // Услуга - Виза
    public function serviceVisa()
    {
        return $this->hasMany(Visa::class);
    }
    // Услуга - Виза
    public function serviceHabitation()
    {
        return $this->hasMany(Habitation::class);
    }
    // Услуга - Топливный сбор
    public function serviceFuelSurchange()
    {
        return $this->hasMany(FuelSurchange::class);
    }
    // Услуга - Экскурсионная программа
    public function serviceExcursion()
    {
        return $this->hasMany(Excursion::class);
    }
    // Услуга - Другая услуга
    public function serviceOther()
    {
        return $this->hasMany(OtherService::class);
    }
    // Добавить файлы
    public function file()
    {
        return $this->hasMany(FileUpload::class);
    }
    // ФИНАНСЫ
    public function prepayment()
    {
        return $this->hasOne(FinancePrepayment::class);
    }
    public function payment()
    {
        return $this->hasOne(FinancePayment::class);
    }
    public function paymentInvoices()
    {
        return $this->hasMany(FinancePaymentInvoice::class);
    }
}
