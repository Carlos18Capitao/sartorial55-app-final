<?php
namespace App\Repositories;

use App\Repositories\Contracts\PercistORM;
use stdClass;

class EncomendaEloquenteORM implements PercistORM
{
    public function getAll(string $filter = null): array
    {
        return [];
    }
    public function findOne(string $id): stdClass|null
    {
        return null;
    }
    public function delete(string $id): void
    {
        return;
    }
    public function new(array $dto): stdClass
    {
        return null;
    }
    public function update(array $dto): stdClass|null
    {
        return null;
    }
    public function updateStatus(string $id, array $status): void
    {
        return;
    }
}
