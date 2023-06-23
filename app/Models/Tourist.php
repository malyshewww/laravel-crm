<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tourist extends Model
{
    use HasFactory;
    use \Bkwld\Cloner\Cloneable;
    protected $cloneable_relations = [
        'common',
        'passport',
        'certificate',
        'internationalPassport',
    ];
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
        return $this->hasOne(TouristDataCommons::class);
    }
    public function passport()
    {
        return $this->hasOne(TouristDataPassport::class);
    }
    public function certificate()
    {
        return $this->hasOne(TouristDataCertificate::class);
    }
    public function internationalPassport()
    {
        return $this->hasOne(TouristDataInternationalPassport::class);
    }
}
