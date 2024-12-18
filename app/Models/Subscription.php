<?php

namespace App\Models;

use App\Events\Api\Subscription\SubscriptionCreatedEvent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email
 */
class Subscription extends Model
{
    protected $guarded = false;

    protected $dispatchesEvents = [
        'created' => SubscriptionCreatedEvent::class,
    ];
}
