<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonDataInternationalPassport extends Model
{
    use HasFactory;
    protected $table = 'person_data_international_passports';
    protected $fillable = [
        'person_id',
        'person_international_passport_series',
        'person_international_passport_number',
        'person_international_passport_date',
        'person_international_passport_period',
        'person_international_passport_issued',
    ];
    protected $casts = [
        'person_international_passport_date' => 'date:d.m.Y', // Свой формат
        'person_international_passport_period' => 'date:d.m.Y', // Свой формат
    ];
    protected $dates = ['person_international_passport_date', 'person_international_passport_period'];
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }
}
