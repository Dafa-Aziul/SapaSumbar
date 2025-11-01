<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_id',
        'admin_id',
        'description',
        'status_update',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function media()
    {
        return $this->hasMany(ProgressMedia::class, 'progress_id');
    }
}
