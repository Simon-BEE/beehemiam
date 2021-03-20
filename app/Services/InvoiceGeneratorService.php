<?php

namespace App\Services;

use App\Models\Order;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Response;

class InvoiceGeneratorService
{
    private ?PDF $pdf = null;
    private string $pdfName;

    public function __construct(public Order $order)
    {
        $this->pdfName = "beehemiam_facture_n{$this->order->id}.pdf";
    }

    public function generate(): self
    {
        $this->pdf = \PDF::loadView('pdf.invoice', [
            'order' => $this->order,
        ]);

        return $this;
    }

    public function stream(): Response
    {
        return $this->pdf->stream($this->pdfName);
    }

    public function download(): Response
    {
        return $this->pdf->download($this->pdfName);
    }
}
