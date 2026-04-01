<?php

namespace App\Services;

use App\Models\Cliente;

class WhatsAppService
{
    public function sendConfirmation(Cliente $cliente, $agendamento)
    {
        // Lógica para enviar mensagem de confirmação via WhatsApp
        // Exemplo: usar Twilio, WhatsApp Business API, etc.

        // Para fins de exemplo, vamos apenas logar a ação
        \Log::info("Enviando confirmação de agendamento para cliente {$cliente->nome} via WhatsApp.");
    }
}
