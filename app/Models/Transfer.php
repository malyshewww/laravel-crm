<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'transfers';
    protected $fillable = [
        'type',
        'transfer_route',
        'datetransfer_start',
        'datetransfer_end',
        'transfer_type',
        'transfer_transport',
        'claim_id',
    ];
    protected $casts = [
        'datetransfer_start' => 'datetime:d.m.Y H:m', // Свой формат
        'datetransfer_end' => 'datetime:d.m.Y H:m', // Свой формат
    ];
    protected $dates = ['datetransfer_start', 'datetransfer_end'];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
