<?php

namespace App\Listeners;

use App\Mail\NewPostPublished;
use App\Models\Subscriber;
use App\Repositories\SubscriberInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class MailSubscriber
{
    public $subscriberRepository;

    /**
     * Create the event listener.
     *
     * @param SubscriberInterface $subscriber
     */
    public function __construct(SubscriberInterface $subscriber)
    {
        $this->subscriberRepository = $subscriber;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $subscribers = $this->subscriberRepository->getAllEmails();
        foreach ($subscribers as $subscriber){
            Mail::to($subscriber)->send(new NewPostPublished($event->post));
        }
    }
}
