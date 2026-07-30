<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use App\Listeners\UpdateLastLoginListener;
use App\Listeners\CreateUserWalletTransaction;
use App\Listeners\WalletCreditListener;
use App\Listeners\WalletDebitListener;
use App\Events\WalletCreditEvent;
use App\Events\WalletDebitEvent;
use App\Events\TransactionSuccessful;
use App\Listeners\UpdateWalletBalance;
use App\Events\SettlementEvent;
use App\Listeners\ProcessSettlement;
use App\Listeners\GenerateSettlement;
use App\Events\ProcessSettlements;
use App\Listeners\ProcessSettlementsListener;


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
            CreateUserWalletTransaction::class,
        ],
        Login::class => [
            UpdateLastLoginListener::class
        ],
        \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\LogSuccessfulLogin::class,
        ],
        WalletCreditEvent::class => [
            WalletCreditListener::class,
        ],
        WalletDebitEvent::class => [
            WalletDebitListener::class,
        ],
        TransactionSuccessful::class => [
            UpdateWalletBalance::class,
        ],
        SettlementEvent::class => [
            ProcessSettlement::class,
        ],
        ProcessSettlements::class => [
            ProcessSettlementsListener::class,
        ],
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
