<?php

namespace Core\Point\Application\Search;

use Core\Point\Infrastructure\Repository\InMemoryPointRepository;

final class BuscarPuntoPorId
{
    private $repository;

    public function __construct(InMemoryPointRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id)
    {
        return $this->repository->getById($id);
    }
}
