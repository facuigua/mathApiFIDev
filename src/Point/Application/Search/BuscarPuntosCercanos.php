<?php

namespace Core\Point\Application\Search;

use Core\Point\Domain\Point;
use Core\Point\Infrastructure\Repository\InMemoryPointRepository;

final class BuscarPuntosCercanos
{
    private $repository;
    private $service;

    public function __construct(InMemoryPointRepository $repository, BuscarPuntoPorId $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function __invoke(string $id, int $cantidad)
    {
        $punto = $this->service->__invoke($id);

        return $this->repository->getNearest(new Point($punto['x'], $punto['y']), $cantidad);
    }
}
