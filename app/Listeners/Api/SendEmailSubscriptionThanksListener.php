<?php

namespace App\Listeners\Api;

use App\Events\Api\Subscription\SubscriptionCreatedEvent;
use App\Mail\Api\SubscriptionThanks;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailSubscriptionThanksListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SubscriptionCreatedEvent $event): void
    {
        Mail::to($event->subscription->email)->send(new SubscriptionThanks);
    }
}
