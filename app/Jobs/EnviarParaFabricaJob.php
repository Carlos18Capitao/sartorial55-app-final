<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EnviarParaFabricaJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public $itemEncomenda;

    /**
     * Create a new job instance.
     */
    public function __construct($itemEncomenda)
    {
        $this->itemEncomenda = $itemEncomenda;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // stub: envio por email / API à fábrica
    }
}
