<?php

namespace Modules\Weather\Listeners;

use Modules\Weather\Events\WeatherPullEvent;
use Modules\Weather\Notifications\WeatherPullNotification;
use Illuminate\Support\Facades\Notification;

class WeatherPullListener
{
    public function handle(WeatherPullEvent $event): void
    {
        Notification::route('mail', 'taylor@example.com')
            ->notify(new WeatherPullNotification());
    }
}
