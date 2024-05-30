@extends('layouts.app')

@section('template_title')
    Orders
@endsection
 <!-- Parte Visual de la pagina Index o Indice de Pedido Order-->
@section('content')
    <form class="form-inline my-2 my-lg-2 float-right" role="search">
        <input name="buscarpor" class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search" value="{{ $buscarpor }}">
        <button class="btn btn-success" type="submit">Buscar</button>   <!-- Boton Buscar del buscador -->
    </form>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Pedidos') }}  <!-- Titulo Pedidos-->
                            </span>
                            <div class="float-right">
                                <a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                  {{ __('Añadir') }}  <!-- Boton Create Añadir -->
                                </a>
                                <a href="{{ route('orders.pdf') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Descargar PDF') }}  <!-- Boton Para descargar PDF -->
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No.Pedido</th>
                                        <th>ID Cliente</th>
                                        <th>Cliente</th>
                                        <th>Producto</th>                    <!-- Titulos de las Filas -->
                                        <th>Imagen</th>
                                        <th>Marca</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->client_id }}</td>       <!-- Parte Logica de los datos de las Columnas order referenciando datos creados  en las tablas -->
                                            <td>{{ $order->client->name }}</td>      <!--  ($order elemento de order)-> client->name (referencia info de nombre clientes -->
                                            <td>{{ $order->items }}</td>
                                            <td>
                                                @if($order->image)  <!-- Campo de imagen  img src es la ubicacion donde estan las imagenes y de ahi la toma-->
                                                <img src="{{ asset('storage/' . $order->image) }}" alt="Imagen del Pedido" style="max-width: 100px; max-height: 100px;"><br>
                                                @else
                                                    Sin imagen  <!-- Si no tiene imagen colocar este mensaje-->
                                                @endif
                                            </td>
                                            <td>{{ $order->brands }}</td>
                                            <td>{{ $order->amounts }}</td>  <!-- Parte Logica de la informacion de las Columnas order referenciando la info creada enlas tablas -->
                                            <td>{{ $order->prices }}</td>
                                            <td>
                                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('orders.show', $order->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>   <!-- Boton Mostrar Show -->
                                                    <a class="btn btn-sm btn-success" href="{{ route('orders.edit', $order->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>      <!-- Boton  Editar Edit -->
                                                    @csrf
                                                    @method('DELETE')  <!-- Boton Eliminar -->
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('¿Seguro que quieres eliminar?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $orders->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
