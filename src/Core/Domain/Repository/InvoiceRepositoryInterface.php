<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Entity;

interface InvoiceRepositoryInterface extends EntityRepositoryInterface
{
    public function delete(string $id): bool;
}