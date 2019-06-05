@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="card mb-4 py-3 border-left-primary-custom">
        <div class="card-body">
            <h3 class="m-0 font-weight-bold text-primary-color">{{ __('Catalogo de Gestores') }}</h3>
        </div>
    </div>
    
    <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-success btn-icon-split mb-4 " >
        <span class="icon text-white-50">
            <i class="fas fa-user-plus"></i>
        </span>
        <span class="text">Agregar Gestor</span>
    </button>

    <div class="card shadow mb-4 border-bottom-primary-custom">
        
        <div class="card-body">
            <div class="table-responsive">
                
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-head">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Teléfono</th>
                            <th>Celular</th>
                            <th>E-mail</th>
                            <th>INE</th>
                            <th>Estatus</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tfoot class="table-footer">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Teléfono</th>
                        <th>Celular</th>
                        <th>E-mail</th>
                        <th>INE</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($gestores as $gestor)
                        <tr>
                            <td>{{ $gestor->nombre }}</td>
                            <td>{{ $gestor->apellidopaterno }}</td>
                            <td>{{ $gestor->apellidomaterno }}</td>
                            <td>{{ $gestor->telefono }}</td>
                            <td>{{ $gestor->celular }}</td>
                            <td>{{ $gestor->correoelectronico }}</td>
                            <td>{{ $gestor->ine }}</td>
                            <td>
                                @if ($gestor->estatus == 'A')
                                <span class="badge badge-success">Activo</span>
                                @elseif ($gestor->estatus == 'B')
                                <span class="badge badge-danger">Baja</span>
                                @elseif ($gestor->estatus == 'S')
                                <span class="badge badge-warning">Suspendido</span>
                                @elseif ($gestor->estatus == 'V')
                                <span class="badge badge-info">Vigente</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('editar-gestor', ['id' => $gestor->id]) }}" class="btn btn-edit btn-sm"><i class="fas fa-edit"></i> </a>
                                <a href="{{ route('gestor-delete', ['id' => $gestor->id]) }}" class="btn btn-delete btn-sm"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Agregar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('gestor-create') }}" aria-label="{{ __('Registrar') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nombre">{{ __('Nombre Completo') }}</label>
                            <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>
                            @if ($errors->has('nombre'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nombre') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="apellidopaterno">{{ __('Apellido Paterno') }}</label>
                                    <input id="apellidopaterno" type="text" class="form-control{{ $errors->has('apellidopaterno') ? ' is-invalid' : '' }}" name="apellidopaterno" value="{{ old('apellidopaterno') }}" required autofocus>
                                    @if ($errors->has('apellidopaterno'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('apellidopaterno') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="apellidomaterno">{{ __('Apellido Materno') }}</label>
                                    <input id="apellidomaterno" type="text" class="form-control{{ $errors->has('apellidomaterno') ? ' is-invalid' : '' }}" name="apellidomaterno" value="{{ old('apellidomaterno') }}" required autofocus>
                                    @if ($errors->has('apellidomaterno'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('apellidomaterno') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="telefono">{{ __('Teléfono') }}</label>
                                    <input id="telefono" type="number" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ old('telefono') }}" required autofocus>
                                    @if ($errors->has('telefono'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('telefono') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="celular">{{ __('Celular') }}</label>
                                    <input id="celular" type="number" class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" name="celular" value="{{ old('celular') }}" required autofocus>
                                    @if ($errors->has('celular'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('celular') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="correoelectronico">{{ __('Correo Electrónico') }}</label>
                            <input id="correoelectronico" type="email" class="form-control{{ $errors->has('correoelectronico') ? ' is-invalid' : '' }}" name="correoelectronico" value="{{ old('correoelectronico') }}" required autofocus>
                            @if ($errors->has('correoelectronico'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('correoelectronico') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="ine">{{ __('INE') }}</label>
                            <input id="ine" type="text" class="form-control{{ $errors->has('ine') ? ' is-invalid' : '' }}" name="ine" value="{{ old('ine') }}" required autofocus>
                            @if ($errors->has('ine'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('ine') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="estatus">{{ __('Estatus') }}</label>

                            <select name="estatus" id="estatus" class="form-control{{ $errors->has('estatus') ? ' is-invalid' : '' }}" value="{{ old('estatus') }}" required autofocus>
                                <option value="">Seleccionar</option>
                                <option value="A">Activo</option>
                                <option value="B">Baja</option>
                                <option value="S">Suspendido</option>
                                <option value="V">Vigente</option>
                            </select>
                            @if ($errors->has('estatus'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('estatus') }}</strong>
                                </span>
                            @endif
                        </div>

                        <hr>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 ">
                                <button type="button" class="btn btn-secondary " data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">{{ __('Crear Gestor') }}</button>
                            </div>
                        </div>

                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection