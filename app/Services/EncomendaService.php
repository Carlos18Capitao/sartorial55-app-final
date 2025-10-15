<?php

namespace App\Services;
use App\Repositories\Contracts\ItemEncomendaORM;

class EncomendaService {

    public function __construct(public ItemEncomendaORM $item){}


}
