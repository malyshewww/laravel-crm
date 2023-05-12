<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuelSurchange extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'fuel_surchanges';
    protected $fillable = [
        'type',
        'fuelsurchange_name',
        'fuelsurchange_date_start',
        'fuelsurchange_date_end',
        'claim_id',
    ];
    protected $casts = [
        'fuelsurchange_date_start' => 'date:d.m.Y', // Свой формат
        'fuelsurchange_date_end' => 'date:d.m.Y', // Свой формат
    ];
    protected $dates = ['fuelsurchange_date_start', 'fuelsurchange_date_end'];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
