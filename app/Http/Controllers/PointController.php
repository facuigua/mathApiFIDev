<?php

namespace App\Http\Controllers;

use Core\Point\Application\Search\BuscarPuntoPorId;
use Core\Point\Application\Search\BuscarPuntos;
use Core\Point\Application\Search\BuscarPuntosCercanos;
use Core\Point\Application\Create\CrearPunto;
use Core\Point\Application\Edit\ModificarPunto;
use Core\Point\Application\Delete\BorrarPunto;

class PointController extends Controller
{
    public function index(BuscarPuntos $puntos)
    {
        try {
            return response()->json($puntos->__invoke());
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } catch (\TypeError $e) {
            return response()->json('Debe ingresar los datos correspondientes a la acción requerida');
        }
    }

    public function create(CrearPunto $puntoCreate)
    {
        try {
            $puntoCreate(request('x'), request('y'));

            return redirect('/puntos');
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } catch (\TypeError $e) {
            return response()->json('Debe ingresar los datos correspondientes a la acción requerida');
        }
    }

    public function edit(ModificarPunto $puntoEdit)
    {
        try {
            $puntoEdit(request('id'), request('x'), request('y'));

            return redirect('/puntos');
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } catch (\TypeError $e) {
            return response()->json('Debe ingresar los datos correspondientes a la acción requerida');
        }
    }

    public function delete(BorrarPunto $puntoDelete)
    {
        try {
            $puntoDelete(request('id'));

            return redirect('/puntos');
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } catch (\TypeError $e) {
            return response()->json('Debe ingresar los datos correspondientes a la acción requerida');
        }
    }

    public function coordinates(BuscarPuntoPorId $puntoObtener)
    {
        try {
            return response()->json($puntoObtener(request('id')));
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } catch (\TypeError $e) {
            return response()->json('Debe ingresar los datos correspondientes a la acción requerida');
        }
    }

    public function near(BuscarPuntosCercanos $puntosCercania)
    {
        try {
            $cantidad = (request('cantidad') ? request('cantidad') : 0);

            return response()->json($puntosCercania(request('id'), $cantidad));
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } catch (\TypeError $e) {
            return response()->json('Debe ingresar los datos correspondientes a la acción requerida');
        }
    }
}
