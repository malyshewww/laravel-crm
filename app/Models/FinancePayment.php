<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancePayment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'finance_payments';
    protected $fillable = [
        'currency',
        'tourist_course',
        'tour_price',
        'comission_price',
        'claim_id'
    ];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
