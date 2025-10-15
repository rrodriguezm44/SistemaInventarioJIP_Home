@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome Administrador</p>
    <hr>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ url('/admin/sucursales') }}">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/edificio.gif') }}" alt="">
                    </span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text"><b>Sucursales</b></span>
                    <span class="info-box-number">{{ $total_sucursales }} Sucursales</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ url('/admin/categorias') }}">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/carpetas.gif') }}" alt="">
                    </span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text"><b>Categorias</b></span>
                    <span class="info-box-number">{{ $total_categorias }} Categorias</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
