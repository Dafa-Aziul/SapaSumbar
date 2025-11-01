<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'progress_id',
        'file_url',
        'file_type',
    ];

    public function progress()
    {
        return $this->belongsTo(ComplaintProgress::class, 'progress_id');
    }
}
