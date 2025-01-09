<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flight extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'flight_number',
        'airline_id'
    ];

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function segments()
    {
        return $this->hasMany(FlightSegmen::class);
    }

    public function classes()
    {
        return $this->hasMany(FlightClass::class);
    }

    public function seats()
    {
        return $this->hasMany(FlightSeat::class);
    }

    public function transactions()
    {
        return $this->hasMany(TransactionFlight::class);
    }

    public function generateSeats()
    {
        $classes = $this->classes;

        foreach ($classes as $class) {
            $totalSeats = $class->total_seats;
            $seatsPerRow = $this->getSeatsPerRow($class->class_type);
            $rows = ceil($totalSeats / $seatsPerRow);

            $existingSeats = FlightSeat::where('flight_id', $this->id)
                ->where('class_type', $class->class_type)
                ->get();

            $existingRows = $existingSeats->pluck('row')->toArray();

            $seatCounter = 1;

            for ($row = 1; $row <= $rows; $row++) {
                if (!in_array($row, $existingRows)) {
                    for ($column = 1; $column <= $seatsPerRow; $column++) {
                        if ($seatCounter > $totalSeats) {
                            break;
                        }

                        $seatCode = $this->generateSeatCode($row, $column);

                        FlightSeat::create([
                            'flight_id' => $this->id,
                            'name' => $seatCode,
                            'row' => $row,
                            'column' => $column,
                            'is_available' => true,
                            'class_type' => $class->class_type,
                        ]);

                        $seatCounter++;
                    }
                }
            }

            foreach ($existingSeats as $existingSeat) {
                if ($existingSeat->column > $seatsPerRow || $existingSeat->row > $rows) {
                    $existingSeat->is_available = false;
                    $existingSeat->save();
                }
            }
        }
    }

    protected function getSeatsPerRow($classType)
    {
        switch (strtolower($classType)) {
            case 'business':
                return 4;
            case 'economy':
                return 6;
            default:
                throw new \Exception("Invalid class type: $classType");
        }
    }


    private function generateSeatCode($row, $column)
    {
        $rowLetter = $this->getRowLetter($row);
        return $rowLetter . $column;
    }

    private function getRowLetter($row)
    {
        $letters = '';
        while ($row > 0) {
            $mod = ($row - 1) % 26;
            $letters = chr(65 + $mod) . $letters;
            $row = (int)(($row - $mod) / 26);
        }
        return $letters;
    }




}



