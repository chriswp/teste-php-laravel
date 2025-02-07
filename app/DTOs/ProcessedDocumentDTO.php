<?php

namespace App\DTOs;

class ProcessedDocumentDTO
{
    public function __construct(
        public int $exercicio,
        public int $categoria_id,
        public string $titulo,
        public string $conteudo
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'exercicio' => $this->exercicio,
            'categoria_id' => $this->categoria_id,
            'titulo' => $this->titulo,
            'conteudo' => $this->conteudo,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['exercicio'],
            $data['categoria_id'],
            $data['titulo'],
            $data['conteudo']
        );
    }
}
