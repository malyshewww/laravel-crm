<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Excursion extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'excursions';
    protected $fillable = [
        'type',
        'excursion_name',
        'excursion_description',
        'excursion_date_start',
        'excursion_date_end',
        'claim_id',
    ];
    protected $casts = [
        'excursion_date_start' => 'date:d.m.Y', // Свой формат
        'excursion_date_end' => 'date:d.m.Y', // Свой формат
    ];
    protected $dates = ['excursion_date_start', 'excursion_date_end'];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
