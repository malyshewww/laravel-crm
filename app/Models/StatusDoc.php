<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusDoc extends Model
{
    use HasFactory;
    use \Bkwld\Cloner\Cloneable;
    protected $table = 'status_docs';
    protected $fillable = [
        'status',
        'claim_id',
    ];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
