<?php

namespace App\Services;

use App\Models\Refund;
use App\Services\ServicesContracts\PDFServiceInterface;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Response;

class CreditGeneratorService implements PDFServiceInterface
{
    public string $pdfName;
    public string $storageFolder;
    private null|PDF|\PDF $pdf = null;

    public function __construct(public Refund $refund)
    {
        $this->pdfName = config('beehemiam.credits.file_prefix') . $this->refund->credit_file_reference . ".pdf";
        $this->storageFolder = config('beehemiam.credits.storage_folder');

        if (!file_exists($this->storageFolder)) {
            mkdir($this->storageFolder);
        }
    }

    public function generate(): self
    {
        $this->pdf = \PDF::loadView('pdf.credit', [
            'refund' => $this->refund,
            'reference' => $this->refund->credit_file_reference,
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
}
