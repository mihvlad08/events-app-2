<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'name', 'description', 'location', 'event_date', 'event_time'
    ];

    public function speakers()
    {
        return $this->hasMany(Speaker::class);
    }

    public function sponsors()
    {
        return $this->hasMany(Sponsor::class);
    }

    public function partners()
    {
        return $this->hasMany(Partner::class);
    }

    public function getId() {
        return $this->id;
    }
}
