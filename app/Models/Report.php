<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'reporter_id',
        'complaint_id',
        'response_id',
        'reason',
        'status',
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    public function response()
    {
        return $this->belongsTo(Response::class);
    }
}
