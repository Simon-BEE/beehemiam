<?php

namespace App\Http\Controllers\Admin\ContactMessage;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Contracts\View\View;

class ShowContactMessageController extends Controller
{
    public function __invoke(ContactMessage $message): View
    {
        $message->markAsRead();

        return view('admin.messages.show', [
            'message' => $message,
        ]);
    }
}
