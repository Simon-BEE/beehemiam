<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Order;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Response;

class InvoiceGeneratorService
{
    public string $invoiceReference;
    public string $pdfName;
    public string $storageFolder;
    private null|PDF|\PDF $pdf = null;

    public function __construct(public Order $order, public Address $address)
    {
        $this->invoiceReference = $this->getInvoiceReference();
        $this->pdfName = "beehemiam_facture_n{$this->invoiceReference}.pdf";
        $this->storageFolder = config('beehemiam.invoices.storage_folder');

        if (!file_exists($this->storageFolder)) {
            mkdir($this->storageFolder);
        }
    }

    public function generate(): self
    {
        $this->pdf = \PDF::loadView('pdf.invoice', [
            'order' => $this->order,
            'address' => $this->address,
            'reference' => $this->invoiceReference,
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

    public function save(): self
    {
        if (!file_exists($this->storageFolder . $this->pdfName)) {
            $this->pdf->save($this->storageFolder . $this->pdfName);
        }

        return $this;
    }

    private function getInvoiceReference(): string
    {
        return 'F' . str_pad(strval($this->order->id), 7, '0', STR_PAD_LEFT);
    }
}
