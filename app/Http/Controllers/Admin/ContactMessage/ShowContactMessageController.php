<?php

namespace App\Http\Controllers\Admin\ContactMessage;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Repositories\ContactMessage\ContactRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowContactMessageController extends Controller
{
    public function show(ContactMessage $message): View
    {
        $message->markAsRead();

        return view('admin.messages.show', [
            'message' => $message,
        ]);
    }

    public function reply(ContactRepository $repository, Request $request, ContactMessage $message): RedirectResponse
    {
        $request->validate([
            'content' => [
                'required', 'string', 'min:4',
            ],
        ]);

        try {
            $repository->reply($message, $request->get('content'));

            return redirect()->route('admin.messages.index')->with([
                'type' => 'Succès',
                'message' => 'Votre message a bien été envoyé',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
