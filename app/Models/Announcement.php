<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'religion_id', 'title', 'content',
        'is_published', 'published_at', 'created_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}