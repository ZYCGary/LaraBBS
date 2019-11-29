<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\{Builder, Collection};
use Illuminate\Support\{Carbon};

/**
 * App\Models\Topic
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property int $user_id
 * @property int $category_id
 * @property int $reply_count
 * @property int $view_count
 * @property int $last_reply_user_id
 * @property int $order
 * @property string|null $excerpt
 * @property string|null $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category $category
 * @property-read Collection|Reply[] $replies
 * @property-read int|null $replies_count
 * @property-read User $user
 * @method static Builder|Topic newModelQuery()
 * @method static Builder|Topic newQuery()
 * @method static Builder|Model ordered()
 * @method static Builder|Topic query()
 * @method static Builder|Topic recent()
 * @method static Builder|Topic recentReplied()
 * @method static Builder|Topic whereBody($value)
 * @method static Builder|Topic whereCategoryId($value)
 * @method static Builder|Topic whereCreatedAt($value)
 * @method static Builder|Topic whereExcerpt($value)
 * @method static Builder|Topic whereId($value)
 * @method static Builder|Topic whereLastReplyUserId($value)
 * @method static Builder|Topic whereOrder($value)
 * @method static Builder|Topic whereReplyCount($value)
 * @method static Builder|Topic whereSlug($value)
 * @method static Builder|Topic whereTitle($value)
 * @method static Builder|Topic whereUpdatedAt($value)
 * @method static Builder|Topic whereUserId($value)
 * @method static Builder|Topic whereViewCount($value)
 * @method static Builder|Topic withOrder($order)
 * @mixin Eloquent
 */
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

    public function link($params = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }
}
