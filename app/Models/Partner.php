<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['name'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
