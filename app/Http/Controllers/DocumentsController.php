<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentUploadRequest;
use App\Services\ImportDocumentsService;

class DocumentsController extends Controller
{
    protected ImportDocumentsService $importDocumentsService;
    public function __construct(ImportDocumentsService $importDocumentsService)
    {
        $this->importDocumentsService = $importDocumentsService;
    }

    public function import()
    {
        return view('upload');
    }

    public function upload(DocumentUploadRequest $request)
    {
        try {
            $file = $request->file('file');
            $this->importDocumentsService->execute($file);
            session()->flash('success', 'Arquivo foi importado com sucesso!');

        }catch (\Exception){
            session()->flash('error', 'Houve uma falha a importar o arquivo');
        }
        return back();
    }
}
