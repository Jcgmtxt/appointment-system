<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'start_time',
        'end_time',
        'doctor_id',
    ];

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = date('H:i', strtotime($value));
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = date('H:i', strtotime($value));
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
