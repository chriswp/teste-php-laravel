<?php

namespace Tests\Unit\Services\DocumentProcess;

use App\Services\DocumentProcess\RemessaParcialProcess;
use App\Constants\Messages;
use PHPUnit\Framework\TestCase;

class RemessaParcialProcessTest extends TestCase
{
    private RemessaParcialProcess $remessaParcialProcess;

    protected function setUp(): void
    {
        parent::setUp();
        $this->remessaParcialProcess = new RemessaParcialProcess();
    }

    public function testValidateThrowsExceptionWhenTitleDoesNotContainMonth(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(Messages::REMESSA_PARCIAL_ERRO_PROCESSO);

        $document = ['titulo' => 'Relatório Anual'];
        $this->remessaParcialProcess->validate($document);
    }

    public function testValidateDoesNotThrowExceptionWhenTitleContainsMonth(): void
    {
        $document = ['titulo' => 'Relatório de Janeiro'];
        $this->remessaParcialProcess->validate($document);
        $this->assertTrue(true);
    }
}
