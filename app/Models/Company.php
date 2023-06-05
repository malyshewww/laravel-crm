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
        'claim_id'
    ];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
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
