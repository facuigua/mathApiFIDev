<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->post('/puntos','PointController@index');
$router->post('/puntos/crear','PointController@create');
$router->post('/puntos/modificar','PointController@edit');
$router->post('/puntos/borrar','PointController@delete');
$router->post('/puntos/ubicacion','PointController@coordinates');
$router->post('/puntos/cercanos','PointController@near');
