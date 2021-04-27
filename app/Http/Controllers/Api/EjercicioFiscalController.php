<?php

namespace App\Http\Controllers\Api;

use App\EjercicioFiscal;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class EjercicioFiscalController extends Controller
{
    public function index()
    {
        return EjercicioFiscal::get(['id', 'anio']);
    }
}
