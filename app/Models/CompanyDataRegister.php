<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDataRegister extends Model
{
    use HasFactory;
    protected $table = 'company_data_registers';
    protected $fillable = [
        'company_kpp',
        'company_inn',
        'company_ogrn',
        'company_id'
    ];
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
