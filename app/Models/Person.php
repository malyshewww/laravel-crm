<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    use \Bkwld\Cloner\Cloneable;
    protected $table = 'persons';
    protected $fillable = [
        'person_surname',
        'person_name',
        'person_patronymic',
        'person_gender',
        'person_surname_lat',
        'person_name_lat',
        'person_nationality',
        'person_birthday',
        'person_address',
        'person_phone',
        'person_email',
        'person_passport_series',
        'person_passport_number',
        'person_passport_date',
        'person_passport_issued',
        'person_passport_code',
        'person_passport_address',
        'person_certificate_series',
        'person_certificate_number',
        'person_certificate_date',
        'person_certificate_issued',
        'person_international_passport_series',
        'person_international_passport_number',
        'person_international_passport_date',
        'person_international_passport_period',
        'person_international_passport_issued',
        'claim_id'
    ];
    protected $casts = [
        'person_certificate_date' => 'date:d.m.Y', // Свой формат
        'person_international_passport_date' => 'date:d.m.Y', // Свой формат
        'person_international_passport_period' => 'date:d.m.Y', // Свой формат
    ];
    protected $dates = [
        'person_certificate_date',
        'person_international_passport_date',
        'person_international_passport_period'
    ];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
