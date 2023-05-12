<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $casts = [
        'date_start' => 'date:d.m.Y', // Свой формат
        'date_end' => 'date:d.m.Y',
    ];
    protected $dates = ['date_start', 'date_end'];
    protected $table = 'tour_packages';
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
