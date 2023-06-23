<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visa extends Model
{
    use HasFactory;
    protected $table = 'visas';
    protected $fillable = [
        'type',
        'visa_name',
        'visa_country',
        'datevisa_start',
        'datevisa_end',
        'claim_id',
    ];
    protected $casts = [
        'datevisa_start' => 'date:d.m.Y', // Свой формат
        'datevisa_end' => 'date:d.m.Y', // Свой формат
    ];
    protected $dates = ['datevisa_start', 'datevisa_end'];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
