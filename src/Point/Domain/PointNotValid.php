<?php

namespace Core\Point\Domain;

use Exception;

final class PointNotValid extends Exception
{
    private const ERROR_MSG = 'El punto/coordenadas ingresados no son válidos';
    private const ERROR_NUM = '0002';

    public function __construct()
    {
        parent::__construct(self::ERROR_MSG, self::ERROR_NUM);
    }
}
