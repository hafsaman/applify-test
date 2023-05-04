<?php

namespace App\listeners;

use App\Events\UpdateHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Storage;

class StoreUserUpdateHistory
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
     * @param  \App\Providers\UpdateHistory  $event
     * @return void
     */
    public function handle(UpdateHistory $event)
    {
        $current_timestamp = Carbon::now()->toDateTimeString();

       // $userinfo = $event->user;
       $message = $event->request->user()->id . 'email : ' .  $event->request->user()->email. ' at ' . $current_timestamp. ' just update user profile.';
       Storage::put('Updateactivity.txt', $message);
    }
}
