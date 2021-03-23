<?php

namespace App\Http\Controllers\Pages;

use App\Events\FormContactMessageSend;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('pages.contact');
    }

    public function send(ContactRequest $request): RedirectResponse
    {
        try {
            event(new FormContactMessageSend(
                $request->get('email'),
                $request->get('object'),
                $request->get('content'),
            ));

            return redirect()->route('contact.index')->with([
                'type' => 'Succès',
                'message' => 'Message bien envoyé !
                    Vous allez recevoir une copie du message à l\'adresse email que vous avez indiqué.',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
