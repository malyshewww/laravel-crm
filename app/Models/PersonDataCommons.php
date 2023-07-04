<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonDataCommons extends Model
{
    use HasFactory;
    protected $table = 'person_data_commons';
    protected $fillable = [
        'person_id',
        'person_gender',
        'person_surname_lat',
        'person_name_lat',
        'person_nationality',
        'person_birthday',
        'person_address',
        'person_phone',
        'person_email',
    ];
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }
}
