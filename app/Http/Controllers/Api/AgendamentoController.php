<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Infrastructure\Services\WhatsApp\WhatsAppService;

class AgendamentoController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'required|integer|exists:clientes,id',
            'date' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $cliente = Cliente::find($data['cliente_id']);

        /** @var WhatsAppService $whats */
        $whats = app(WhatsAppService::class);
        $whats->sendSchedulingConfirmation($cliente, $data);

        return response()->json(['ok' => true], 201);
    }
}
