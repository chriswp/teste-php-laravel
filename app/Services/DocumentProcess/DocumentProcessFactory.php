<?php

namespace App\Services\DocumentProcess;

class DocumentProcessFactory
{
    public static function execute(int $category): DocumentProcessInterface
    {
        return match ($category) {
            1 => new RemessaProcess(),
            2 => new RemessaParcialProcess(),
            default => throw new \Exception("Categoria inválida: $category"),
        };
    }
}
