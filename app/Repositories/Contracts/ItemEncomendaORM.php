<?php

namespace App\Repositories\Contracts;
use Illuminate\Database\Eloquent\Model;

interface ItemEncomendaORM
{
    public function newItem(array $dado): Model;
    public function getAllItems(): array;
    public function findOne(string $id): Model;
    public function update(string $id, array $data): Model|null;
    public function updateStatus(string $id, array $status): bool;
    public function delete(string $id): void;
    public function getById(string $id): Model|null;
}
