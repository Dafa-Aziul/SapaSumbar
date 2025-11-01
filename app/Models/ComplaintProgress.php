<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintProgress extends Model
{
    use HasFactory;

    protected $table = 'complaint_progress';

    protected $fillable = [
        'complaint_id',
        'admin_id',
        'status_update',
        'description',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class, 'complaint_id');
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
