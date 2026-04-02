<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'religion_id', 'user_id', 'subject', 'message', 'status',
    ];

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}