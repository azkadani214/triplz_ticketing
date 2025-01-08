<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainSeat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'train_id',
        'name',
        'row',
        'column',
        'class_type',
        'is_available'
    ];

    public function train()
    {
        return $this->belongsTo(Train::class);
    }
}
