<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use App\Models\User;

class ReadNotificationController extends Controller
{
    public function __invoke(string $notification)
    {
        /** @var User $admin */
        $admin = auth()->user();

        $notification = $admin->notifications()->findOrFail($notification);

        try {
            $notification->markAsRead();

            return back()->with([
                'type' => 'Succès',
                'message' => 'Notification lue',
            ]);
        } catch (\Exception $e) {
            throw new \Exception("Notification introuvable " . $e->getMessage(), 1);
        }
    }
}
