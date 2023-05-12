<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonCertificate extends Model
{
    use HasFactory;
    protected $table = 'person_certificates';
    protected $fillable = [
        'person_certificate_series',
        'person_certificate_number',
        'person_certificate_date',
        'person_certificate_issued',
        'person_id',
    ];
    protected $casts = [
        'person_certificate_date' => 'date:d.m.Y', // Свой формат
    ];
    protected $dates = ['person_certificate_date'];
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }
}
