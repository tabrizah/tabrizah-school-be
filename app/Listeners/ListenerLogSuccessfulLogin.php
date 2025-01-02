<?php

namespace App\Listeners;

use App\Enum\EnumSystemLogAction;
use App\Enum\EnumSystemLogType;
use App\Events\EventUserAuthenticated;
use App\Traits\Loggable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenerLogSuccessfulLogin
{
    use Loggable;

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
    public function handle(EventUserAuthenticated $event): void
    {
                $this->log(
                    userId: $event->user?->id ?? null,
                    type: EnumSystemLogType::UserActivity->value,
                    action: EnumSystemLogAction::View->value,
                    entityType: 'User',
                    entityId: $event->user?->id ?? null,  // Added null safe operator and null coalesce
                    description: 'User authenticated via API',
                    additionalMetadata: array_merge(
                        ['token_type' => 'sanctum'],
                        $event->metadata
                    )
                );
    }
}
