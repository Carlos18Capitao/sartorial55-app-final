<?php

namespace App\Repositories\Contracts;
use Illuminate\Database\Eloquent\Model;

interface ItemEncomendaORM
{
    public function new(string $dado): Model|null;
    public function getAll(): array;
    public function findOne(string $id): Model|null;
    public function update(string $id, array $data): Model|null;
    public function updateStatus(string $id, array $status): void;
    public function delete(string $id): void;
    public function getById(string $id): Model|null;
}
