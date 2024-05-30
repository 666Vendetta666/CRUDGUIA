@extends('layouts.app')

@section('template_title')
    {{ $client->name ?? __('Show') . " " . __('Client') }}
@endsection
<!-- Parte Visual de la pagina Mostrar SHOW de CLientes -->
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Client</span> <!-- Titulo  CLiente-->
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('clients.index') }}"> {{ __('Back') }}</a> <!-- Boton para volver al indice  -->
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong> <!-- Titulo Nombre -->
                                    {{ $client->name }} <!-- dato de name tabla clientes-->
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Apellido:</strong> <!-- Titulo Apellido -->
                                    {{ $client->lastname }} <!-- dato de lastname tabla clientes-->
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Direccion:</strong> <!-- Titulo Direccion-->
                                    {{ $client->addres }} <!-- dato de name addres tabla  clientes-->
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Telefono:</strong> <!-- Titulo Telefono-->
                                    {{ $client->phone }} <!-- dato de phone  tabla clientes-->
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
