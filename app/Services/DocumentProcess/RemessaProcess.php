<?php

namespace App\Services\DocumentProcess;

use App\Constants\Messages;

class RemessaProcess implements DocumentProcessInterface
{

    public function validate(array $documentDTO): void
    {
        if (!str_contains(strtolower($documentDTO['titulo']), 'semestre')) {
        throw new \Exception(Messages::REMESSA_ERRO_PROCESSO);
    }
    }
}
