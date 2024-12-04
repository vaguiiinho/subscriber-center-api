<?php

namespace App\Repositories\Eloquent;

use App\Models\Contract as Model;
use App\Repositories\Presenter\PaginationPresenter;
use Core\Domain\Entity\Entity;
use Core\Domain\Entity\Contract as EntityContract;
use Core\Domain\Repository\ContractRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\ValueObject\Uuid;

class ContractEloquentRepository implements ContractRepositoryInterface
{
    public function __construct(protected Model $model) {}

    public function insert($entity): Entity
    {
        $response = $this->model->create([
            'id' => $entity->id,
            'activationDate' => $entity->activationDate,
            'renewalDate' => $entity->renewalDate,
            'contractStatus' => $entity->contractStatus,
            'internetStatus' => $entity->internetStatus,
            'idExternal' => $entity->idExternal
        ]);

        if ($address = $entity->address()) {
            $response->address()->create([
                'street' => $address->getStreet(),
                'number' => $address->getNumber(),
                'neighborhood' => $address->getNeighborhood(),
                'complement' => $address->getComplement(),
                'city' => $address->getCity(),
            ]);
        }

        return $this->toContract($response);
    }

    public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface
    {
        $query = $this->model->newQuery();
        if ($filter) {
            $query->where('status', 'LIKE', "%{$filter}%");
        }
        $query->orderBy('id', $order);
        $paginator = $query->paginate();

        return new PaginationPresenter($paginator);
    }

    private function toContract(object $entity): EntityContract
    {
        return new EntityContract(
            id: new Uuid($entity->id),
            activationDate: $entity->activationDate,
            renewalDate: $entity->renewalDate,
            contractStatus: $entity->contractStatus,
            internetStatus: $entity->internetStatus,
            idExternal: $entity->idExternal,
        );
    }
}
