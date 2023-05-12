<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDataContact extends Model
{
    use HasFactory;
    protected $table = 'company_data_contacts';
    protected $fillable = [
        'company_address',
        'company_actual_address',
        'company_director',
        'company_phone',
        'company_email',
        'company_id'
    ];
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
