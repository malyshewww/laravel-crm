<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    use HasFactory;
    protected $table = 'flights';
    protected $fillable = [
        'type',
        'flight_route',
        'flight_start',
        'flight_end',
        'flight_aviacompany',
        'flight_class',
        'flight_number',
        'dateflight_start',
        'dateflight_end',
        'claim_id',
    ];
    protected $casts = [
        'dateflight_start' => 'datetime:d.m.Y H:m', // Свой формат
        'dateflight_end' => 'datetime:d.m.Y H:m', // Свой формат
    ];
    protected $dates = ['dateflight_start', 'dateflight_end'];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
