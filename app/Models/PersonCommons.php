<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonCommons extends Model
{
    use HasFactory;
    protected $table = 'person_commons';
    protected $fillable = [
        'person_gender',
        'person_surname_lat',
        'person_name_lat',
        'person_nationality',
        'person_birthday',
        'person_address',
        'person_phone',
        'person_email',
        'person_id',
    ];
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }
}
