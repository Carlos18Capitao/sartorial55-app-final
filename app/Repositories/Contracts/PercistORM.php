<?php

namespace App\Repositories\Contracts;

use stdClass;
interface PercistORM
{
    #public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function getAll(string $filter = null): array;
    public function findOne(string $id): stdClass|null;
    public function delete(string $id): void;
    public function new(array $dto): stdClass;
    public function update(array $dto): stdClass|null;
    public function updateStatus(string $id, array $status): void;
}
