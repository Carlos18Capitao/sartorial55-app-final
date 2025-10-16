<?php
namespace App\Repositories;

use App\Models\Casaco;
use App\Repositories\Contracts\PercistORM;
use stdClass;

class CasacoEloquenteORM implements PercistORM {

public function getAll(string $filter = null): array
    {
        return Casaco::all()->toArray()?? [];
    }
    public function findOne(string $id): stdClass|null
    {
        $Casaco = Casaco::find($id);
        return $Casaco ? (object) $Casaco->toArray() : null;
    }
    public function delete(string $id): void
    {
        $Casaco = Casaco::find($id);
        if ($Casaco) {
            $Casaco->delete();
        }
    }
    public function new(array $dto): stdClass
    {
        $Casaco = new Casaco();
        $Casaco->fill((array) $dto);
        $Casaco->save();
        return (object) $Casaco->toArray();
    }
    public function update(array $dto): stdClass|null
    {
        $Casaco = Casaco::find($dto['id'] ?? null);
        if ($Casaco) {
            $Casaco->fill((array) $dto);
            $Casaco->save();
            return (object) $Casaco->toArray();
        }
        return null;
    }
    public function updateStatus(string $id, array $status): void
    {
        $Casaco = Casaco::find($id);
        if ($Casaco) {
            $Casaco->status = $status;
            $Casaco->save();
        }
    }
}
