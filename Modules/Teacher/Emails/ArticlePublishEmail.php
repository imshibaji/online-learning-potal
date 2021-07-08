<?php

namespace Modules\Teacher\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticlePublishEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $article;
    // public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($article)
    {
        $this->article = $article;
        // $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->subject('Article: '. $this->article->title)->view('teacher::emails.article');
        return $this->subject('Article: '. $this->article->title)->markdown(
            'teacher::emails.article'
        );
    }
}
