<?php

namespace App\Mail\Orders;

use App\Models\Order;
use App\Models\Refund;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderRefundMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public Refund $refund)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orders.refunded')
            ->subject("Commande n°{$this->refund->order->id} remboursée")
            ->attach($this->refund->file_path, [
                'as' => config('beehemiam.credits.file_prefix') . $this->refund->credit_file_reference . ".pdf",
                'mime' => 'application/pdf',
            ]);
    }
}
