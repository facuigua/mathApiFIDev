<?php

namespace Core\Point\Application\Edit;

use Core\Point\Domain\Point;
use Core\Point\Domain\PointNotValid;
use Core\Point\Infrastructure\Repository\InMemoryPointRepository;

final class ModificarPunto
{
    private $repository;

    public function __construct(InMemoryPointRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id, float $x, float $y)
    {
        $point = new Point($x, $y);

        $this->repository->edit($id, $point);
    }
}
