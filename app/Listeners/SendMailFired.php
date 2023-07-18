<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\MessagesendMail;
use App\Models\User;
use Mail;

class SendMailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    public function handle(SendMail $event)
    {
        
        $user = User::find($event->userId);
        $data=$event->data;
        $data['name']=$user->name;
        Mail::to($user)->send(new MessagesendMail($data));
    }
}
