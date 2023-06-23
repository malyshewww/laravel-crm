<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileUpload extends Model
{
    use HasFactory;
    protected $table = "files";
    protected $fillable = [
        'file_name',
        'file_original_name',
        'file_type',
        'claim_id',
    ];
    protected $casts = [
        'created_at' => 'date:d.m.Y H:m', // Свой формат
    ];
    protected $dates = ['created_at'];
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }
}
