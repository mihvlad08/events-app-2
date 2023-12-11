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

    public static function deleteAllEvents()
    {
        self::query()->delete();
    }

    public static function deleteEvent($id)
    {
        $event = self::find($id);
    
        if ($event) {
            // You may want to delete related records (speakers, sponsors, etc.) before deleting the event
            $event->delete();
            return true; // or return a success message if needed
        } else {
            return false; // or return an error message if needed
        }
    }
    
}
