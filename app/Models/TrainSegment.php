<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainSegment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sequence',
        'train_id',
        'station_id',
        'time'
    ];

    public function train()
    {
        return $this->belongsTo(Train::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
