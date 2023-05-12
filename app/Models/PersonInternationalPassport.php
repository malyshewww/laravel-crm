<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonInternationalPassport extends Model
{
    use HasFactory;
    protected $table = 'person_international_passports';
    protected $fillable = [
        'person_international_passport_series',
        'person_international_passport_number',
        'person_international_passport_date',
        'person_international_passport_period',
        'person_international_passport_issued',
        'person_id',
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
