<?php

namespace App\Repositories\Eloquent;

use App\Models\Customer as Model;
use App\Repositories\Presenter\PaginationPresenter;
use Core\Domain\Entity\{
    Entity,
    Customer as EntityCustomer
};
use Core\Domain\Repository\{
    CustomerRepositoryInterface,
    PaginationInterface
};
use Core\Domain\ValueObject\CnpjCpf;
use Core\Domain\ValueObject\Uuid;

class CustomerEloquentRepository implements CustomerRepositoryInterface
{
    public function __construct(protected Model $model) {}

    public function insert($entity): Entity
    {
        $response = $this->model->create([
            'id' => $entity->id,
            'active' => $entity->active,
            'personType' => $entity->personType,
            'name' => $entity->name,
            'cnpj_cpf' => $entity->cnpj_cpf,
            'birthDate' => $entity->birthDate,
            'registrationDate' => $entity->registrationDate,
            'idExternal' => $entity->idExternal,
        ]);

        return $this->toCustomer($response);
    }

    public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface
    {
        $query = $this->model->newQuery();
        if ($filter) {
            $query->where('name', 'LIKE', "%{$filter}%");
        }
        $query->orderBy('id', $order);
        $paginator = $query->paginate();

        return new PaginationPresenter($paginator);
    }

    private function toCustomer(object $entity): EntityCustomer
    {
        return new EntityCustomer(
            id: new Uuid($entity->id),
            active: $entity->active,
            personType: $entity->personType,
            name: $entity->name,
            cnpj_cpf: new CnpjCpf($entity->cnpj_cpf),
            birthDate: $entity->birthDate,
            registrationDate: $entity->registrationDate,
            idExternal: $entity->idExternal,
        );
    }
}
