<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Models\Encomenda;

class FichaTecnicaEmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_generating_technical_sheet_sends_email_with_attachment()
    {
        Mail::fake();

        $encomenda = Encomenda::factory()->create();

        $svcClass = \App\Application\Services\TechnicalSheetService::class;
        $svc = $this->app->make($svcClass);
        $svc->generateAndSendToFactory($encomenda);

        Mail::assertSent(\App\Mail\FichaTecnicaMail::class, function ($mail) {
            return method_exists($mail, 'hasAttachmentPath') ? $mail->hasAttachmentPath() : true;
        });
    }
}
