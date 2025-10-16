<?php

namespace App\Services;
use App\Repositories\ClientEloquenteORM;
use App\Repositories\Contracts\PercistORM;

class EncomendaService {

    public function __construct(public PercistORM $item){}

    public function new(ClientEloquenteORM $cliente){
        
    }
}
