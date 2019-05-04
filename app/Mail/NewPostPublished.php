<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewPostPublished extends Mailable
{
    use Queueable, SerializesModels;

    public $post;

    /**
     * Create a new message instance.
     * @param $post
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new_post');
    }
}
