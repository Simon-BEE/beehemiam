<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\MessageFromContactMail;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('pages.contact');
    }

    public function send(ContactRequest $request): RedirectResponse
    {
        try {
            Mail::to(User::administrators()->get())
                ->send(
                    new MessageFromContactMail(
                        $request->get('email'),
                        $request->get('subject'),
                        $request->get('message')
                    )
                );

            return redirect(route('contact.index') . '#formContact')->with([
                'type' => 'Succès',
                'message' => 'Message bien envoyé !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);

        }
    }
}
