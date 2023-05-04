<?php

namespace App\listeners;

use App\Events\RegisterHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Storage;

class StoreUserRegisterHistory
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
     * @param  \App\Providers\RegisterHistory  $event
     * @return void
     */
    public function handle(RegisterHistory $event)
    {
        $current_timestamp = Carbon::now()->toDateTimeString();

       // $userinfo = $event->user;
        $message = $event->request->user()->id . $current_timestamp. ' just register in to the application.';
        Storage::put('Registeractivity.txt', $message);
    }
}
