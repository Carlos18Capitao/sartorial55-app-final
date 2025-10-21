<?php
namespace App\Repositories;

use App\Models\Casaco;
use App\Repositories\Contracts\ItemEncomendaORM;

class CasacoEloquenteORM implements ItemEncomendaORM {


    public function newItem(array $dado): \Illuminate\Database\Eloquent\Model {
        $casaco = Casaco::create($dado);
        return $casaco;

    }
    public function getAllItems(): array {
        return Casaco::all()->toArray();
    }
    public function findOne(string $id): \Illuminate\Database\Eloquent\Model {
        return $this->getById($id);
    }
    public function update(string $id, array $data): \Illuminate\Database\Eloquent\Model {
        $casaco = $this->getById($id);
        if (!$casaco) {
            throw new \Exception('Casaco not found');
        }
        $casaco->update($data);
        return $casaco;
    }
    public function updateStatus(string $id, array $status): bool {
        $Casaco = $this->getById($id);
        if ($Casaco) {
            $Casaco->update($status);
            return true;
        }
        return false;
    }
    public function delete(string $id): void {
        $Casaco = $this->getById($id);
        if ($Casaco) {
            $Casaco->delete();
        }
    }
    public function getById(string $id): \Illuminate\Database\Eloquent\Model{
        return Casaco::find($id) ?? throw new \Exception('Casaco not found');
    }
}
