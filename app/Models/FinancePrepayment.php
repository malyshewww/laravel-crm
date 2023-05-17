<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancePrepayment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'finance_prepayments';
    protected $fillable = [
        'percent',
        'days',
        'claim_id'
    ];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
