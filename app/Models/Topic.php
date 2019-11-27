<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];

    /**
     * Get the topic's category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the user who posts the topic.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the replies of the topic.
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    /**
     * Sort topics with specific order.
     */
    public function scopeWithOrder($query, $order)
    {
        switch ($order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
    }

    /**
     * Order topics according to Recent Replied.
     */
    public function scopeRecentReplied($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    /**
     * Order topics according to Recent Posted.
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
