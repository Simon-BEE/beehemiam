<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    public function read(string $notification): RedirectResponse
    {
        $notification = request()->user()->notifications()->findOrFail($notification);

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

    public function delete(string $notification): RedirectResponse
    {
        $notification = request()->user()->notifications()->findOrFail($notification);

        try {
            $notification->delete();

            return back()->with([
                'type' => 'Succès',
                'message' => 'Notification supprimée',
            ]);
        } catch (\Exception $e) {
            throw new \Exception("Notification introuvable " . $e->getMessage(), 1);
        }
    }
}
