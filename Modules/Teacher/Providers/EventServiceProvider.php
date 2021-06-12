<?php

namespace Modules\Teacher\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Teacher\Events\ActivityEvent;
use Modules\Teacher\Events\ArticlePublish;
use Modules\Teacher\Listeners\ActivityListener;
use Modules\Teacher\Listeners\ArticleListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ArticlePublish::class => [
            ArticleListener::class,
        ],
        ActivityEvent::class => [
            ActivityListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
