<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristDataPassport extends Model
{
    use HasFactory;
    protected $table = 'tourist_data_passports';
    protected $fillable = [
        'tourist_id',
        'tourist_passport_series',
        'tourist_passport_number',
        'tourist_passport_date',
        'tourist_passport_issued',
        'tourist_passport_code',
        'tourist_passport_address',
    ];
    public function tourist()
    {
        return $this->belongsTo(Tourist::class, 'tourist_id', 'id');
    }
}
