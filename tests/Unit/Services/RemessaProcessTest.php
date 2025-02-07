<?php

use PHPUnit\Framework\TestCase;
use App\Services\DocumentProcess\RemessaProcess;
use App\Constants\Messages;

class RemessaProcessTest extends TestCase
{
    private RemessaProcess $remessaProcess;

    protected function setUp(): void
    {
        $this->remessaProcess = new RemessaProcess();
    }

    public function testValidateThrowsExceptionWhenTituloDoesNotContainSemestre(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(Messages::REMESSA_ERRO_PROCESSO);

        $documentDTO = ['titulo' => 'Processo de Remessa'];
        $this->remessaProcess->validate($documentDTO);
    }

    public function testValidateDoesNotThrowExceptionWhenTituloContainsSemestre(): void
    {
        $documentDTO = ['titulo' => 'semestre de Processamento de Remessa'];
        $this->remessaProcess->validate($documentDTO);
        $this->assertTrue(true);
    }
}
