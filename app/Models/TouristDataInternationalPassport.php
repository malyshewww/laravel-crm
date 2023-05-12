<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristDataInternationalPassport extends Model
{
    use HasFactory;
    protected $table = 'tourist_data_international_passports';
    protected $fillable = [
        'tourist_id',
        'tourist_international_passport_series',
        'tourist_international_passport_number',
        'tourist_international_passport_date',
        'tourist_international_passport_period',
        'tourist_international_passport_issued'
    ];
    protected $casts = [
        'tourist_international_passport_date' => 'date:d.m.Y', // Свой формат
        'tourist_international_passport_period' => 'date:d.m.Y', // Свой формат
    ];
    protected $dates = ['tourist_international_passport_date', 'tourist_international_passport_period'];
    public function tourist()
    {
        return $this->belongsTo(Tourist::class, 'tourist_id', 'id');
    }
}
