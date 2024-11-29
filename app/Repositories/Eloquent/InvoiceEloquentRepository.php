<?php

namespace App\Repositories\Eloquent;

use App\Models\Invoice as Model;
use App\Repositories\Presenter\PaginationPresenter;
use Core\Domain\Entity\Entity;
use Core\Domain\Entity\Invoice as EntityInvoice;
use Core\Domain\Repository\InvoiceRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\ValueObject\Uuid;

class InvoiceEloquentRepository implements InvoiceRepositoryInterface
{
    public function __construct(protected Model $model) {}

    public function insert($entity): Entity
    {
        $response = $this->model->create([
            'id' => $entity->id,
            'emissionDate' => $entity->emissionDate,
            'maturityDate' => $entity->maturityDate,
            'amount' => $entity->amount,
            'receiptType' => $entity->receiptType,
            'status' => $entity->status,
            'idExternal' => $entity->idExternal
        ]);

        return $this->toInvoice($response);
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

    private function toInvoice(object $entity): EntityInvoice
    {
        return new EntityInvoice(
            id: new Uuid($entity->id),
            emissionDate: $entity->emissionDate,
            maturityDate: $entity->maturityDate,
            amount: $entity->amount,
            receiptType: $entity->receiptType,
            status: $entity->status,
            idExternal: $entity->idExternal,
        );
    }
}
