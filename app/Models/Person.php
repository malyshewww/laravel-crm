<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';
    protected $fillable = [
        'person_surname',
        'person_name',
        'person_patronymic',
        'claim_id'
    ];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
    public function commons()
    {
        return $this->hasOne(PersonCommons::class);
    }
    public function passport()
    {
        return $this->hasOne(PersonPassport::class);
    }
    public function certificate()
    {
        return $this->hasOne(PersonCertificate::class);
    }
    public function internationalPassport()
    {
        return $this->hasOne(PersonInternationalPassport::class);
    }
}
