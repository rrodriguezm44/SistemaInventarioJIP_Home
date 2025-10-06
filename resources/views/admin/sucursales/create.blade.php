@extends('adminlte::page')

@section('content_header')

    <nav aria-label="breadcrumb" style="font-size: 18pt;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/sucrsales') }}">Sucursales</a></li>
            <li class="breadcrumb-item active" aria-current="page">Creacion de Sucursales</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Llene los datos del Formulario</b></h3>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    <form action="{{ url('/admin/sucursales/create') }}" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre de la Sucursal <b>(*)</b></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('nombre') }}" class="form-control" id="nombre" name="nombre"
                                        placeholder="Ingrese el nombre de la Sucursal" required>
                                    </div>
                                    @error('nombre')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="direccion">Dirección <b>(*)</b></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('direccion') }}" class="form-control" id="direccion" name="direccion"
                                        placeholder="Ingrese la Dirección" required>
                                    </div>
                                    @error('direccion')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="telefono">Teléfono <b>(*)</b></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('telefono') }}" class="form-control" id="telefono" name="telefono"
                                        placeholder="Ingrese el número de Telefono" required>
                                    </div>
                                    @error('telefono')
                                        <div class="alert alert-danger">{{ $message }}</div>   
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="activa">Estado <b>(*)</b></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-check"></i></span>
                                        </div>
                                        <select class="form-control" name="activa" id="activa" required>
                                            <option value="">-- Seleccione una opción --</option>
                                            <option value="1" {{ old('activa') == '1' ? 'selected' : '' }}>Activo</option>
                                            <option value="0" {{ old('activa') == '0' ? 'selected' : '' }}>Inactivo</option>
                                        </select>
                                    @error('activa')
                                        <div class="alert alert-danger">{{ $message }}</div>   
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="{{ url('admin/sucursales') }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
