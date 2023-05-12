<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insurance extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'insurances';
    protected $fillable = [
        'type',
        'insurance_name',
        'insurance_company',
        'insurance_type',
        'insurance_type_other',
        'dateinsurance_start',
        'dateinsurance_end',
        'insurance_sum',
        'claim_id',
    ];
    protected $casts = [
        'dateinsurance_start' => 'date:d.m.Y', // Свой формат
        'dateinsurance_end' => 'date:d.m.Y', // Свой формат
    ];
    protected $dates = ['dateinsurance_start', 'dateinsurance_end'];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
