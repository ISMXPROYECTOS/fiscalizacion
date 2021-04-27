<?php

namespace App\Http\Controllers\Api;

use App\TipoDeInspeccion;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class TipoInspeccionController extends Controller
{
    public function index()
    {
        return TipoDeInspeccion::get(['id', 'nombre']);
    }
}
