@extends('layouts.app')

@section('template_title')
    {{ $order->name ?? __('Show') . " " . __('Order') }}
@endsection
 <!-- Parte Visual de la pagina Mostrar SHOW de Pedidos -->
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Pedido</span>  <!-- Titulo Pedido-->
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('orders.index') }}"> {{ __('Volver') }}</a>  <!-- Boton volver a pagina indice-->
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>ID del Cliente:</strong>  <!-- Titulo ID CLiente -->
                                    {{ $order->client_id }} <!-- informacion de client_id (relacion id tabla clientes)-->
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Producto:</strong>  <!-- titulo Producto-->
                                    {{ $order->items }}  <!-- Informacion de items-->
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Imagen del Producto:</strong>  <!-- Titulo Imagen del producto-->
                                    <td>
                                        @if($order->image)  <!-- Imagen del producto y de donde se guarda para mostrarla-->
                                            <img src="{{ asset('storage/' . $order->image) }}" alt="Imagen del Pedido" style="max-width: 100px; max-height: 100px;">
                                             @else <!-- si no hay, mostrar este mensaje -->
                                            Sin imagen
                                         @endif
                                     </td>
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Marca:</strong> <!-- titulo Marca-->
                                    {{ $order->brands }} <!-- Informacion de brands-->
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Cantidad:</strong> <!-- titulo cantidad-->
                                    {{ $order->amounts }} <!-- Informacion de amounts-->
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Precio:$</strong> <!-- titulo Precio-->
                                    {{ $order->prices }} <!-- Informacion de orices-->
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
