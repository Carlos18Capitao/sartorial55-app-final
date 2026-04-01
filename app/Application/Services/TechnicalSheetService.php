<?php
namespace App\Application\Services;

use App\Models\Encomenda;
use App\Mail\FichaTecnicaMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TechnicalSheetService
{
    /**
     * Gera uma ficha técnica simples (arquivo temporário) e envia por email à fábrica.
     * Método intentionally minimal para TDD.
     */
    public function generateAndSendToFactory(Encomenda $order): void
    {
        // Gera conteúdo simples como placeholder
        $content = "Ficha técnica para Encomenda #{$order->id}\nTipo: placeholder\nMedidas: placeholder\n";

        // Grava em storage temporário
        $path = 'fichas_tecnicas/ficha_encomenda_' . $order->id . '.txt';
        Storage::disk('local')->put($path, $content);
        $fullPath = Storage::disk('local')->path($path);

        // Envia email (destinatário placeholder)
        Mail::to(config('mail.factory_address', 'factory@example.com'))
            ->send(new FichaTecnicaMail($order, $fullPath));

        // opcional: remover ficheiro se quiseres
        // Storage::disk('local')->delete($path);
    }
}
