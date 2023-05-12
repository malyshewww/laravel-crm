<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Touroperator extends Model
{
    use HasFactory;
    protected $table = 'touroperators';
    protected $fillable = ['title', 'claim_id'];

    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
