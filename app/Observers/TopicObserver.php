<?php

namespace App\Observers;

use App\Models\Topic;
use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Str;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic)
    {
        // Purify topic body content to prevent XSS
        $topic->body = clean($topic->body, 'user_topic_body');
        $topic->excerpt = make_excerpt($topic->body);

        // If slug is null, generate slug for the topic.
        if ( ! $topic->slug) {
            $topic->slug = Str::slug($topic->title, '-');
        }
    }
}