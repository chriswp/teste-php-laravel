<?php

namespace App\Jobs;

use App\Models\Document;
use App\Services\DocumentProcess\DocumentProcessFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessDocumentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }


    public function handle(): void
    {
        info('Processando documento');
        try {

            $processor = DocumentProcessFactory::execute($this->data['categoria_id']);
            $processor->validate($this->data);

            Document::create([
                'exercicio' => $this->data['exercicio'],
                'category_id' => $this->data['categoria_id'],
                'title' => $this->data['titulo'],
                'contents' => $this->data['conteudo']
            ]);

            Log::info("Documento salvo com sucesso: ".$this->data['titulo']);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao processar documento: ".$e->getMessage());
        }
    }

}
