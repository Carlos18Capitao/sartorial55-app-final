<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ComprarTecidoJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public $payment; // ou encomenda dependendo do teu evento

    /**
     * Create a new job instance.
     */
    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // stub: lógica de compra de tecido real ficará aqui
        // Por enquanto apenas placeholder para testes
    }
}
