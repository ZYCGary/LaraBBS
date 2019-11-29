<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\{Carbon};

/**
 * App\Models\Reply
 *
 * @property int $id
 * @property int $topic_id
 * @property int $user_id
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Topic $topic
 * @property-read User $user
 * @method static Builder|Reply newModelQuery()
 * @method static Builder|Reply newQuery()
 * @method static Builder|Model ordered()
 * @method static Builder|Reply query()
 * @method static Builder|Model recent()
 * @method static Builder|Reply whereContent($value)
 * @method static Builder|Reply whereCreatedAt($value)
 * @method static Builder|Reply whereId($value)
 * @method static Builder|Reply whereTopicId($value)
 * @method static Builder|Reply whereUpdatedAt($value)
 * @method static Builder|Reply whereUserId($value)
 * @mixin Eloquent
 */
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
