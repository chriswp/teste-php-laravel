<?php

namespace App\Services;

use App\Builders\DocumentBuilder;
use App\Constants\Messages;
use App\Jobs\ProcessDocumentJob;
use App\Repositories\DocumentRepository;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
    public function execute(UploadedFile $file): void
    {
        try {
            $importData = $this->readJsonFile($file);
            foreach ($importData->get() as $documento) {
                ProcessDocumentJob::dispatch($documento->jsonSerialize());
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function readJsonFile(UploadedFile $file)
    {
        $jsonContent = file_get_contents($file->getRealPath());
        $decodedJson = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->withErrors(['file' => 'O arquivo não é um JSON válido.']);
        }
        $builder = new DocumentBuilder($decodedJson);
        return $builder->fromArray($decodedJson);
    }
}
