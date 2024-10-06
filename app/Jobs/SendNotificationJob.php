<?php

namespace App\Jobs;

use App\Events\NotificationSent;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $notification;

    public function __construct(User $user, Notification $notification)
    {
        $this->user = $user;
        $this->notification = $notification;
    }

    public function handle()
    {

        Mail::raw($this->notification->message, function ($message) {
            $message->to($this->user->email)
                ->subject($this->notification->type . ' Notification');
        });


        $broadcast_message = [
            'message'=>$this->notification->message,
            'user name' => $this->user->name,
            'user email' => $this->user->email
        ];

        broadcast(new NotificationSent($broadcast_message));


        $this->notification->update(['status' => 'sent']);
    }
}
