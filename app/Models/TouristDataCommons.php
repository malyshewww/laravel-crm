<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristDataCommons extends Model
{
    use HasFactory;
    protected $table = 'tourist_data_commons';
    protected $fillable = [
        'tourist_id',
        'tourist_gender',
        'tourist_surname_lat',
        'tourist_name_lat',
        'tourist_nationality',
        'tourist_birthday',
        'tourist_address',
        'tourist_phone',
        'tourist_email',
        'visa_info',
        'visa_city'
    ];
    public function tourist()
    {
        return $this->belongsTo(Tourist::class, 'tourist_id', 'id');
    }
}
