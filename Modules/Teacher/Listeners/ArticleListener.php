<?php

namespace Modules\Teacher\Listeners;

use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
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

        if(
            $event->article->type == 'publish'
            && $event->article->image_path != null
            && $event->article->approved == 1
        ){
            // For testing
            // Mail::to(Auth::user())
            //     ->send(new ArticlePublishEmail($event->article));

            // Production
            $usersEmail = User::all()->pluck('email')->toArray();
            $subsEmails = Subscribe::all()->pluck('email')->toArray();

            $allEmails = array_merge($usersEmail, $subsEmails);
            $emails = array_unique($allEmails);
            // dd($emails);

            foreach ($emails as $email) {
                Mail::to($email)
                ->send(new ArticlePublishEmail($event->article));
            }
        }
    }
}
