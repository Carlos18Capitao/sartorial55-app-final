<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\ItemEncomenda;
use Illuminate\Support\Facades\DB;

class StatisticsService
{
    /**
     * Get dashboard statistics.
     *
     * @return array
     */
    public function getDashboardStats(): array
    {
        return [
            'total_clientes' => Cliente::count(),
            'total_encomendas' => Encomenda::count(),
            'total_itens' => ItemEncomenda::count(),
            'item_counts' => ItemEncomenda::selectRaw('tipo, COUNT(*) as count')
                ->groupBy('tipo')
                ->pluck('count', 'tipo')
                ->toArray(),
            'encomendas_por_status' => Encomenda::selectRaw('estado, COUNT(*) as count')
                ->groupBy('estado')
                ->pluck('count', 'estado')
                ->toArray(),
            'clientes_top' => Cliente::withCount('encomendas')
                ->orderBy('encomendas_count', 'desc')
                ->limit(5)
                ->get()
                ->map(fn($cliente) => [
                    'id' => $cliente->id,
                    'nome' => $cliente->user->name ?? 'N/A',
                    'encomendas_count' => $cliente->encomendas_count,
                ])
                ->toArray(),
            'encomendas_recentes' => Encomenda::with('cliente.user')
                ->latest()
                ->limit(10)
                ->get()
                ->map(fn($encomenda) => [
                    'id' => $encomenda->id,
                    'cliente' => $encomenda->cliente->user->name ?? 'N/A',
                    'estado' => $encomenda->estado,
                    'data' => $encomenda->created_at->format('Y-m-d'),
                ])
                ->toArray(),
        ];
    }

    /**
     * Get client statistics.
     *
     * @return array
     */
    public function getClientStats(): array
    {
        return [
            'total_clientes' => Cliente::count(),
            'clientes_ativos' => Cliente::whereHas('encomendas', fn($q) => $q->where('created_at', '>=', now()->subDays(30)))->count(),
            'clientes_com_encomendas' => Cliente::has('encomendas')->count(),
            'media_encomendas_por_cliente' => Cliente::avg('encomendas_count') ?? 0,
        ];
    }

    /**
     * Get order statistics.
     *
     * @return array
     */
    public function getOrderStats(): array
    {
        return [
            'total_encomendas' => Encomenda::count(),
            'encomendas_mes' => Encomenda::whereMonth('created_at', now()->month)->count(),
            'media_itens_por_encomenda' => Encomenda::avg('itens_count') ?? 0,
        ];
    }

    /**
     * Get item statistics by type.
     *
     * @return array
     */
    public function getItemStats(): array
    {
        return ItemEncomenda::selectRaw('tipo, COUNT(*) as total')
            ->groupBy('tipo')
            ->get()
            ->keyBy('tipo')
            ->toArray();
    }
}
