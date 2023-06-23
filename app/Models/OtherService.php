<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtherService extends Model
{
    use HasFactory;
    protected $table = 'other_services';
    protected $fillable = [
        'type',
        'other_service_name',
        'otherservice_date_start',
        'otherservice_date_end',
        'claim_id',
    ];
    protected $casts = [
        'otherservice_date_start' => 'date:d.m.Y', // Свой формат
        'otherservice_date_end' => 'date:d.m.Y', // Свой формат
    ];
    protected $dates = ['otherservice_date_start', 'otherservice_date_end'];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
