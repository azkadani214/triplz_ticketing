<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainFacility extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'image',
        'name',
        'description'
    ];

    /**
     * Relasi ke train classes.
     */
    public function classes()
    {
        return $this->belongsToMany(TrainClass::class, 'train_class_facility', 'facility_id', 'train_class_id');
    }
}
