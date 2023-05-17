<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancePaymentInvoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'finance_payment_invoices';
    protected $fillable = [
        'calculate',
        'sum',
        'currency',
        'date_invoices',
        'claim_id',
    ];
    protected $casts = [
        'date_invoices' => 'datetime:d.m.Y H:m', // Свой формат
    ];
    protected $dates = ['date_invoices'];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
