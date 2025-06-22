<?php

namespace App\Models;

use App\Casts\TimeCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    protected $fillable = [
        'business_id',
        'day_of_week',
        'open_time',
        'close_time',
        'is_closed',
    ];

    protected function casts(): array
    {
        return [
            'day_of_week' => 'int',
            'open_time' => TimeCast::class,
            'close_time' => TimeCast::class,
            'is_closed' => 'bool',
        ];
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }



    //Desde Schedule, podré acceder a un atributo llamado day_of_week_string que me dirá el día en vez de el número
    public function dayOfWeekString(): Attribute
    {
        return Attribute::make(
            get: fn() => match ($this->day_of_week) {
                1 => 'Lunes',
                2 => 'Martes',
                3 => 'Miércoles',
                4 => 'Jueves',
                5 => 'Viernes',
                6 => 'Sábado',
                7 => 'Domingo',
                default => 'Desconocido',
            }
        );
    }
}
