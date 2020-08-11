<?php

namespace Core\Point\Application\Delete;

use Core\Point\Domain\Point;
use Core\Point\Infrastructure\Repository\InMemoryPointRepository;

final class BorrarPunto
{
    private $repository;

    public function __construct(InMemoryPointRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id)
    {
        $this->repository->delete($id);
    }
}
