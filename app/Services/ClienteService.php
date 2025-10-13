<?php


namespace App\Services;

use App\Repositories\ClientEloquenteORM;

class ClienteService
{
    private ClientEloquenteORM $repository;

    public function __construct(ClientEloquenteORM $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): ?object
    {
        return $this->repository->findOne($id);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

    public function new(array $dto): object
    {
        return $this->repository->new($dto);
    }

    public function update(array $dto): ?object
    {
        return $this->repository->update($dto);
    }

    public function updateStatus(string $id, array $status): void
    {
        $this->repository->updateStatus($id, $status);
    }
}
