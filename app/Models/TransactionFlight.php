<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionFlight extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'flight_id',
        'flight_class_id',
        'name',
        'email',
        'phone',
        'number_of_passengers',
        'promo_code_id',
        'payment_status',
        'subtotal',
        'grandtotal'
    ];

    public function passengers(): HasMany
    {
        return $this->hasMany(TransactionPassenger::class, 'transaction_id');
    }

    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }

    public function flightClass(): BelongsTo
    {
        return $this->belongsTo(FlightClass::class);
    }

    public function promoCode(): BelongsTo
    {
        return $this->belongsTo(PromoCode::class);
    }
}

class TransactionPassenger extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'transaction_id',
        'flight_seat_id',
        'name',
        'date_of_birth',
        'nationality'
    ];

    protected $casts = [
        'date_of_birth' => 'date'
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(TransactionFlight::class, 'transaction_id');
    }

    public function flightSeat(): BelongsTo
    {
        return $this->belongsTo(FlightSeat::class);
    }
}
