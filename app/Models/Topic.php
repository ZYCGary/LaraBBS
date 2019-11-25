<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    /**
     * Identify the relationship between Topic and Category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Identify the relationship between Topic and User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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
