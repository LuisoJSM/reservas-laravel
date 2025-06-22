<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'image',
        'max_future_days',
        'slot_duration',
    ];


    protected function casts(): array
    {
        return [
            'name' => 'string',
            'phone' => 'string',
            'address' => 'string',
            'image' => 'string',
            'max_future_days' => 'int',
            'slot_duration' => 'int',

        ];
    }


    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function slots()
    {
        return $this->hasMany(Slot::class);
    }




}
