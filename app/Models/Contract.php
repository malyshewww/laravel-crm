<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'contracts';
    protected $fillable = [
        'date',
        'number',
        'claim_id',
    ];
    protected $casts = [
        'date' => 'date:d.m.Y', // Свой формат
    ];
    protected $dates = ['date'];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
