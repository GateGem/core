<?php

namespace GateGem\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'command',
        'params',
        'output',
        'options'
    ];

    protected $casts = [
        'params' => 'array',
        'options' => 'array'
    ];
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }
}
