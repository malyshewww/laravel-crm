<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDataBank extends Model
{
    use HasFactory;
    protected $table = 'company_data_banks';
    protected $fillable = [
        'company_bank',
        'company_bik',
        'company_rs',
        'company_ks',
        'company_id'
    ];
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
