<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ImportFile
{
    public function execute(UploadedFile $file): void;
}
