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
}
