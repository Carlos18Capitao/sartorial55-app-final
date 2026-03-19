<?php

namespace App\Http\Controllers;

use App\Services\StatisticsService;
use Inertia\Inertia;

class DashboardController extends Controller
{
    protected $statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    /**
     * Display dashboard with statistics.
     */
    public function index()
    {
        $stats = $this->statisticsService->getDashboardStats();

        return Inertia::render('Dashboard-app', [
            'stats' => $stats,
        ]);
    }
}
