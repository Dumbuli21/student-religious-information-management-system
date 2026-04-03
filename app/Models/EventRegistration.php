<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $fillable = [
        'event_id', 'user_id', 'registered_at',
        'attended', 'attended_at', 'marked_by',
    ];

    protected $casts = [
        'registered_at' => 'datetime',
        'attended_at'   => 'datetime',
        'attended'      => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markedBy()
    {
        return $this->belongsTo(User::class, 'marked_by');
    }
}