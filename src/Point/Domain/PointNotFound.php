<?php

namespace Core\Point\Domain;

use Exception;

final class PointNotFound extends Exception
{
    private const ERROR_MSG = 'No se encontró el punto';
    private const ERROR_NUM = '0001';

    public function __construct()
    {
        parent::__construct(self::ERROR_MSG, self::ERROR_NUM);
    }
}
