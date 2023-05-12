<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonPassport extends Model
{
    use HasFactory;
    protected $table = 'person_passports';
    protected $fillable = [
        'person_passport_series',
        'person_passport_number',
        'person_passport_date',
        'person_passport_issued',
        'person_passport_code',
        'person_passport_address',
        'person_id',
    ];
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }
}
