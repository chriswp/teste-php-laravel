<?php

namespace App\Services\DocumentProcess;

use App\Builders\DocumentBuilder;
use App\Constants\Messages;
use App\DTOs\DocumentDTO;
use App\DTOs\ProcessedDocumentDTO;

class RemessaParcialProcess implements DocumentProcessInterface
{

    public function validate(array $document): void
    {
        if (!$this->tituloHasMonth($document['titulo'])) {
            throw new \Exception(Messages::REMESSA_PARCIAL_ERRO_PROCESSO);
        }
    }

    private function tituloHasMonth(string $title): bool
    {
        $months = getMonths();

        foreach ($months as $month) {
            if (str_contains(strtolower($title), $month)) {
                return true;
            }
        }

        return false;
    }
}
