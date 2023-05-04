<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\RegisterHistory;
use App\Listeners\StoreUserRegisterHistory;
use App\Events\LoginHistory;
use App\Listeners\StoreUserLoginHistory;

use App\Events\ResetHistory;
use App\Listeners\StoreUserResetHistory;

use App\Events\UpdateHistory;
use App\Listeners\StoreUserUpdateHistory;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        RegisterHistory::class => [
            StoreUserRegisterHistory::class,
        ],
        LoginHistory::class => [
            StoreUserLoginHistory::class,
        ],
        ResetHistory::class => [
            StoreUserResetHistory::class,
        ],
        UpdateHistory::class => [
            StoreUserUpdateHistory::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
