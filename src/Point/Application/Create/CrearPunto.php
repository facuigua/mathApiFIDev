<?php

namespace Core\Point\Application\Create;

use Core\Point\Domain\Point;
use Core\Point\Infrastructure\Repository\InMemoryPointRepository;

final class CrearPunto
{
    private $repository;

    public function __construct(InMemoryPointRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(float $x, float $y)
    {
        $point = new Point($x, $y);

        $this->repository->create($point);
    }
}
