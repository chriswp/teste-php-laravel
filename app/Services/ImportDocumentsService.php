<?php

namespace App\Services;

use App\Builders\DocumentBuilder;
use App\Constants\Messages;
use App\DTOs\ArquivoJsonDTO;
use App\DTOs\ProcessedDocumentDTO;
use App\Jobs\ProcessDocumentJob;
use App\Models\Document;
use App\Repositories\DocumentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ImportDocumentsService implements ImportFile
{
    protected DocumentRepository $repository;

    public function __construct(DocumentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws \Exception
     */
    public function execute(string $filename): void
    {
       $importData =  $this->readJsonFile($filename);
       foreach ($importData->get() as $documento) {
           ProcessDocumentJob::dispatch($documento->jsonSerialize());
       }
    }

    private function readJsonFile(string $filename): DocumentBuilder
    {
        $storage = Storage::disk('data');
        if (!$storage->exists($filename)) {
            throw new \Exception(Messages::ARQUIVO_NAO_ENCONTRADO);
        }
        $contents =  $storage->json($filename);
        $builder = new DocumentBuilder($contents);
        return $builder->fromArray($contents);
    }
}
