<?php


namespace Core\Point\Infrastructure\Repository;

use Core\Point\Domain\Point;
use Core\Point\Domain\PointNotFound;
use Core\Point\Domain\PointRepository;
use Illuminate\Support\Facades\Cache;

class InMemoryPointRepository implements PointRepository
{
    private $puntos;

    public function __construct()
    {
        $this->puntos = $this->searchAll();
    }

    public function searchAll(): ?array
    {
        if (!Cache::has('puntos')) {
            return [];
        }

        return Cache::get('puntos');
    }

    public function getById(string $id): ?array
    {
        $key = $this->searchById($id);

        if (!is_null($key)) {
            return $this->puntos[$key];
        }

        throw new PointNotFound();
    }

    private function searchById(string $id): ?int
    {
        if (count($this->puntos) == 0) {
            return null;
        }

        $keyId = array_search($id, array_column($this->puntos, 'id'));

        if ($keyId !== false) {
            return $keyId;
        }

        return null;
    }

    private function searchByCoordinates(float $x, float $y): ?int
    {
        $key = $this->filterPoints($x, $y);

        if (!is_null($key)) {
            return $key;
        }

        return null;
    }

    private function getKey()
    {
        if (count($this->puntos) == 0) {
            return 0;
        }

        return array_key_last($this->puntos) + 1;
    }

    private function getId(int $key)
    {
        $i = 0;

        $idNuevoPunto = '';

        $idPuntos = array_column($this->puntos, 'id');

        while($idNuevoPunto == '')
        {
            $i++;

            $id = 'p' . $i;

            if (!in_array($id, $idPuntos)) {
                $idNuevoPunto = $id;
            }
        }

        return $idNuevoPunto;
    }

    private function persist(array $puntos): void
    {
        Cache::put('puntos', array_values($puntos));
    }

    public function create(Point $punto): void
    {
        $key = $this->searchByCoordinates($punto->getX(), $punto->getY());

        if (is_null($key)) {
            $key = $this->getKey();
        }

        $id = $this->getId($key);

        $this->puntos[$key] = [
            'id' => $id,
            'x' => $punto->getX(),
            'y' => $punto->getY()
        ];

        $this->persist($this->puntos);
    }

    public function edit(string $id, Point $punto): void
    {
        $key = $this->searchById($id);

        if (is_null($key)) {
            $key = $this->getKey();
        }

        $this->puntos[$key] = [
            'id' => $id,
            'x' => $punto->getX(),
            'y' => $punto->getY()
        ];

        $this->persist($this->puntos);
    }

    public function delete(string $id): void
    {
        $key = $this->searchById($id);

        if (!is_null($key)) {
            unset($this->puntos[$key]);
        }

        $this->persist($this->puntos);
    }

    public function getNearest(Point $punto, int $cantidad): ?array
    {
        return $this->searchNearest($punto, $cantidad);
    }

    private function searchNearest(Point $punto, int $cantidad): ?array
    {
        $cercanos = [];

        $key = $this->searchByCoordinates($punto->getX(), $punto->getY());

        $cercanos = $this->compareAndGetPoints($key, $punto);

        $cercanos = $this->orderAndFilterNearestPoints($cercanos, $cantidad);

        return $cercanos;
    }

    private function compareAndGetPoints(int $indice, Point $punto)
    {
        $resultado = [];

        foreach ($this->puntos as $index => $item) {
            if ($indice != $index) {
                $puntoCompara = new Point($item['x'], $item['y']);

                $cercano['id'] = $item['id'];
                $cercano['x'] = $puntoCompara->getX();
                $cercano['y'] = $puntoCompara->getY();
                $cercano['distancia'] = $punto->distance($puntoCompara);

                $resultado[] = $cercano;
            }
        }

        return $resultado;
    }

    private function orderAndFilterNearestPoints(array $puntos, int $cantidad)
    {
        #Ordenar por distancia y filtrar por cantidad solicitada
        $distancias = array_column($puntos, 'distancia');

        array_multisort($distancias, SORT_ASC, $puntos);

        if ($cantidad) {
            $puntos = array_slice($puntos, 0, $cantidad);
        }

        return $puntos;
    }

    private function filterPoints(float $x, float $y)
    {
        foreach ($this->puntos as $key => $punto) {
            if ($punto['x'] == $x && $punto['y'] == $y) {
                return (int) $key;
            }
        }

        return null;
    }
}
