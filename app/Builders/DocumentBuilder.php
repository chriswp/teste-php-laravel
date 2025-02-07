<?php

namespace App\Builders;


use App\DTOs\ProcessedDocumentDTO;

class DocumentBuilder
{
    private array $documentos = [];

    public function fromArray(array $data): self
    {
        foreach ($data['documentos'] as $documento) {
            $this->documentos[] = new ProcessedDocumentDTO(
                $data['exercicio'],
                $this->mapCategoria($documento['categoria']),
                $documento['titulo'],
                $documento['conteúdo']
            );
        }

        return $this;
    }

    private function mapCategoria(string $categoria): int
    {
        $map = [
            'Remessa' => 1,
            'Remessa Parcial' => 2,
        ];

        return $map[$categoria] ?? 0;
    }

    public function get(): array
    {
        return $this->documentos;
    }
}
