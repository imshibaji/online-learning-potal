<?php

namespace Modules\Teacher\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Modules\Teacher\Emails\ArticlePublishEmail;
use Modules\Teacher\Events\ArticlePublish;

class ArticleListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ArticlePublish $event)
    {

        if($event->article->type == 'publish'){
            $users = User::all();
            foreach ($users as $user) {
                Mail::to($user)
                ->send(new ArticlePublishEmail($event->article, $user));
            }
        }
    }
}
