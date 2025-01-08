<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'train_id',
        'class_name',
        'price',
        'total_seats'
    ];

    /**
     * Relasi ke fasilitas yang tersedia untuk kelas kereta.
     */
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'train_class_facility', 'train_class_id', 'facility_id');
    }
}
