<?php

namespace App\Services\ServicesContracts;

use Illuminate\Http\Response;

interface PDFServiceInterface
{
    public function generate(): self;

    public function stream(): Response;

    public function download(): Response;

    public function save(): self;
}
