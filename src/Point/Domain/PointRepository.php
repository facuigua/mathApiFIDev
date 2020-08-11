<?php

namespace Core\Point\Domain;

interface PointRepository
{
    public function searchAll(): ?array;
    public function getById(string $id): ?array;
    public function getNearest(Point $punto, int $cantidad): ?array;
    public function create(Point $punto): void;
    public function edit(string $id, Point $punto): void;
    public function delete(string $id): void;
}
