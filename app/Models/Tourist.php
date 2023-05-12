<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tourist extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = 'tourists';
    protected $fillable = [
        'tourist_surname',
        'tourist_name',
        'tourist_patronymic',
        'claim_id'
    ];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
    public function common()
    {
        return $this->hasOne(TouristDataCommons::class, 'tourist_id', 'id');
    }
    public function passport()
    {
        return $this->hasOne(TouristDataPassport::class, 'tourist_id', 'id');
    }
    public function certificate()
    {
        return $this->hasOne(TouristDataCertificate::class, 'tourist_id', 'id');
    }
    public function internationalPassport()
    {
        return $this->hasOne(TouristDataInternationalPassport::class);
    }
}
