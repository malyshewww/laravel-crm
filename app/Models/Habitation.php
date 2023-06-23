<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Habitation extends Model
{
    use HasFactory;
    protected $table = 'habitations';
    protected $fillable = [
        'type',
        'habitation_name',
        'habitation_resort',
        'habitation_hotel',
        'habitation_hotel_address',
        'habitation_type_number',
        'habitation_type_placement',
        'habitation_type_food',
        'datehabitation_start',
        'datehabitation_end',
        'claim_id',
    ];
    protected $casts = [
        'datehabitation_start' => 'datetime:d.m.Y H:m', // Свой формат
        'datehabitation_end' => 'datetime:d.m.Y H:m', // Свой формат
    ];
    protected $dates = ['datehabitation_start', 'datehabitation_end'];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
