<?php

namespace Modules\Teacher\Events;

use App\Models\Article;
use Illuminate\Queue\SerializesModels;

class ArticlePublish
{
    use SerializesModels;

    public $article;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['mail'];
    }
}
