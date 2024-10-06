<?php

namespace App\Http\Controllers;

use App\Jobs\SendNotificationJob;
use App\Models\Notification;
use App\Models\NotificationType;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email',
            'full_name' => 'required|string|max:255',
            'notification_type' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            $user = User::create([
                'name' => $validated['full_name'],
                'email' => $validated['email'],
            ]);
        }

        $userNotificationExists = $user->notificationTypes()
            ->where('type', $validated['notification_type'])
            ->exists();

        // If the user doesn't have the notification type, create it
        if (!$userNotificationExists) {
            $notificationType = NotificationType::where('type', $validated['notification_type'])->first();

            if ($notificationType) {
                UserNotification::create([
                    'user_id' => $user->id,
                    'notification_type_id' => $notificationType->id,
                ]);
            }
        }

        $usersWithNotificationType = User::whereHas('notificationTypes', function($query) use ($validated) {
            $query->where('id', $validated['notification_type']);
        })->get();

        foreach ($usersWithNotificationType as $recipient) {
            $notification = Notification::create([
                'type' => $validated['notification_type'],
                'message' => 'New ' . $validated['notification_type'] . ' by ' . $validated['full_name'],
            ]);

            SendNotificationJob::dispatch($recipient, $notification);
        }

        return redirect()->back()->with('success', 'Notifications sent successfully.');
    }
}
