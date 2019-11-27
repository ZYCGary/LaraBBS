<?php

namespace App\Models;

class Reply extends Model
{
    protected $fillable = ['content'];

    /**
     * Get the topic of the reply.
     */
    public function topic ()
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Get the user who post the reply.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
