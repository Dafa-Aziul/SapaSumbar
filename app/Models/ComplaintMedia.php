<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_id',
        'file_url',
        'file_type',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    /**
     * Accessor otomatis untuk menampilkan URL publik file.
     * Supaya <img src="{{ $media->file_public_url }}"> bisa langsung dipakai di view.
     */
    public function getFilePublicUrlAttribute(): ?string
    {
        return $this->file_url ? asset('storage/' . $this->file_url) : null;
    }
}
