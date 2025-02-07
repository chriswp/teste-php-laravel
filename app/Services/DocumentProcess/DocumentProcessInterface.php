<?php

namespace App\Services\DocumentProcess;

interface DocumentProcessInterface
{
    public function validate(array $documentDTO): void;
}
