<?php

namespace App\DTOs;

class DocumentDTO
{
    public function __construct(
        public string $categoria,
        public string $titulo,
        public string $conteudo
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            categoria: $data['categoria'],
            titulo: $data['titulo'],
            conteudo: $data['conteúdo']
        );
    }

    public function toArray(): array
    {
        return [
            'categoria' => $this->categoria,
            'titulo' => $this->titulo,
            'conteudo' => $this->conteudo,
        ];
    }
}
