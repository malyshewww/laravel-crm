<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'type',
        'claim_id'
    ];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
