<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'event_name', 'from', 'to', 'specific_days', 'month'
    ];

    protected $casts = [
        'specific_days' => 'json'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
