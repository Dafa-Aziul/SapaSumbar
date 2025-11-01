<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_id',
        'media_path',
        'file_type',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    // accessor otomatis: hasilkan URL publik dari media_path
    public function getFileUrlAttribute()
    {
        return $this->media_path ? asset('storage/' . $this->media_path) : null;
    }
}
