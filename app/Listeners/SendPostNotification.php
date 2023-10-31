<?php

namespace App\Listeners;

use App\Events\PostProcessed;
use App\Mail\UserMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendPostNotification
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
    public function handle(PostProcessed $event): void
    {
        $user =  User::all();
        foreach ($user as $value) {
            Mail::to($value->email)->send(new UserMail($event->post));
        }
    }
}
