<?php

namespace Core\Point\Application\Search;

use Core\Point\Infrastructure\Repository\InMemoryPointRepository;

final class BuscarPuntos
{
    private $repository;

    public function __construct(InMemoryPointRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        return $this->repository->searchAll();
    }
}
