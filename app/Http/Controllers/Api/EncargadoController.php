<?php

namespace App\Http\Controllers\Api;

use App\Encargado;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class EncargadoController extends Controller
{
    public function index()
    {
        return Encargado::get(['id', 'nombre', 'apellidopaterno', 'apellidomaterno', 'puesto']);
    }
}
