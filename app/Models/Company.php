<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable = [
        'company_fullname',
        'company_shortname',
        'customer_id'
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function register()
    {
        return $this->hasOne(CompanyDataRegister::class);
    }
    public function bank()
    {
        return $this->hasOne(CompanyDataBank::class);
    }
    public function contact()
    {
        return $this->hasOne(CompanyDataContact::class);
    }
}
