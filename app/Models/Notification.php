<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'religion_id', 'type', 'title', 'message', 'reference_id', 'is_read'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }
}