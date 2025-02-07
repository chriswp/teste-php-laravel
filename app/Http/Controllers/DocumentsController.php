<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Services\ImportDocumentsService;
use App\Validators\DocumentValidator;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Constants\Messages;

class DocumentsController extends PainelController
{
    protected ImportDocumentsService $importDocumentsService;
    public function __construct(ImportDocumentsService $importDocumentsService)
    {
        $this->importDocumentsService = $importDocumentsService;
    }

    public function readJsonFile()
    {
        $filename = '2023-03-28.json';
        $this->importDocumentsService->execute($filename);
        return 'agora foi campeao';
    }
    protected function repository(): RepositoryInterface
    {
       return app(Document::class);
    }

    protected function viewIndex(): string
    {
        return 'documents.index';
    }

    protected function variablesIndex(): array
    {
       return [];
    }

    protected function validator(): ValidatorInterface
    {
        return app(DocumentValidator::class);
    }

    protected function viewCreate(): string
    {
        return 'documents.create';
    }

    protected function variablesCreate(): array
    {
        return [];
    }

    protected function viewShow(): string
    {
        return 'documents.show';
    }

    protected function variablesShow(): array
    {
        return [];
    }

    protected function viewEdit(): string
    {
        return 'documents.edit';
    }

    protected function variablesEdit(): array
    {
        return [];
    }
}
