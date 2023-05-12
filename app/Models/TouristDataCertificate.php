<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristDataCertificate extends Model
{
    use HasFactory;
    protected $table = 'tourist_data_certificates';
    protected $fillable = [
        'tourist_id',
        'tourist_certificate_series',
        'tourist_certificate_number',
        'tourist_certificate_date',
        'tourist_certificate_issued',
    ];
    protected $casts = [
        'tourist_certificate_date' => 'date:d.m.Y', // Свой формат
    ];
    protected $dates = ['tourist_certificate_date'];
    public function tourist()
    {
        return $this->belongsTo(Tourist::class, 'tourist_id', 'id');
    }
}
