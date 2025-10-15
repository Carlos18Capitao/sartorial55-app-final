<?php
namespace App\Repositories;

use App\Repositories\Contracts\ItemEncomendaORM;
use Illuminate\Database\Eloquent\Model;

class CasacoEloquenteORM implements ItemEncomendaORM {

    public function new(string $dado): Model|null {
        return null;
    }
    public function getAll(): array {
        return [];
    }
    public function findOne(string $id): Model|null {
        return null;
    }
    public function update(string $id, array $data): Model|null {
        return null;
    }
    public function updateStatus(string $id, array $status): void {
        return;
    }
    public function delete(string $id): void {
        return;
    }
    public function getById(string $id): Model|null {
        return null;
    }
}
