<?php

namespace App\Repositories\Contracts;
use Illuminate\Database\Eloquent\Model;
use stdClass;

interface ItemEncomendaORM
{
    public function new(array $dado): stdClass;
    public function getAll(): array;
    public function findOne(string $id): stdClass;
    public function update(string $id, array $data): stdClass|null;
    public function updateStatus(string $id, array $status): void;
    public function delete(string $id): void;
    public function getById(string $id): Model|null;
}
