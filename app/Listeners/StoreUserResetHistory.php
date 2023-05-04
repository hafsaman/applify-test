<?php

namespace App\listeners;

use App\Events\ResetHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Storage;

class StoreUserResetHistory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\ResetHistory  $event
     * @return void
     */
    public function handle(ResetHistory $event)
    {
        $current_timestamp = Carbon::now()->toDateTimeString();

       // $userinfo = $event->user;
        $message = $event->request->user()->id . 'email : ' .  $event->request->user()->email. ' at ' . $current_timestamp. ' just Reset password  application.';
        Storage::put('Resetactivity.txt', $message);
    }
}
