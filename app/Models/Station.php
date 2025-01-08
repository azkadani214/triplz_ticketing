<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Station extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'station_code',
        'name',
        'image',
        'city',
        'region'
    ];

    public function segments()
    {
        return $this->hasMany(TrainSegment::class);
    }
}
