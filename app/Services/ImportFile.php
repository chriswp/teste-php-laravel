<?php

namespace App\Services;

interface ImportFile
{
    public function execute(string $filename): void;
}
