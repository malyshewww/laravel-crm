<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    use \Bkwld\Cloner\Cloneable;
    protected $table = 'companies';
    protected $fillable = [
        'company_fullname',
        'company_shortname',
        'company_kpp',
        'company_inn',
        'company_ogrn',
        'company_id',
        'company_bank',
        'company_bik',
        'company_rs',
        'company_ks',
        'company_address',
        'company_actual_address',
        'company_director',
        'company_phone',
        'company_email',
        'claim_id',
    ];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
