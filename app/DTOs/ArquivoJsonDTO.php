<?php

namespace App\DTOs;

class ArquivoJsonDTO
{
    /**
     * @param int $exercicio
     * @param DocumentDTO[] $documentos
     */
    public function __construct(
        public int $exercicio,
        public array $documentos
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            exercicio: $data['exercicio'],
            documentos: array_map(fn($doc) => DocumentDTO::fromArray($doc), $data['documentos'])
        );
    }

    public function toArray(): array
    {
        return [
            'exercicio' => $this->exercicio,
            'documentos' => array_map(fn($doc) => $doc->toArray(), $this->documentos),
        ];
    }
}
