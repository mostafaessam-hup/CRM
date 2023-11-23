<?php

namespace App\Providers;

use Crm\Customer\Events\CustomerCreation;
use Crm\Customer\Listeners\NotifySalesOnCustomerCreation;
use Crm\Customer\Listeners\SendProjectCreationEmail;
use Crm\Project\Events\ProjectCreation;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CustomerCreation::class=>[
            NotifySalesOnCustomerCreation::class,
        ],
        ProjectCreation::class=>[
            SendProjectCreationEmail::class,
        ]

    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
