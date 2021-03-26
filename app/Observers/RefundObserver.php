<?php

namespace App\Observers;

use App\Mail\Orders\OrderRefundMail;
use App\Models\Refund;
use App\Services\CreditGeneratorService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class RefundObserver
{
    /**
     * Handle the Refund "created" event.
     *
     * @param  \App\Models\Refund  $refund
     * @return void
     */
    public function created(Refund $refund)
    {
        $creditGenerator = new CreditGeneratorService($refund);

        if (!\App::environment('testing')) {
            $creditGenerator->generate()->save();
        }

        Mail::to($refund->order->email_contact)->send(new OrderRefundMail($refund));
    }
}
