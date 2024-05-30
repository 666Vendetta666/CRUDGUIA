@extends('layouts.app')

@section('template_title')
    Clients
@endsection
 <!-- Parte Visual de la pagina Index o Indice de Clientes  client-->
@section('content')
    <div class="container-fluid">
        <form class="form-inline my-2 my-lg-2 float-right" role="search">
            <input name="buscarpor" class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search" value="{{ $buscarpor}}">
            <button class="btn btn-success" type="submit">Buscar</button>  <!-- Boton Buscar del buscador -->
            </form>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Clientes') }} <!-- Titulo Clientes-->
                            </span>

                             <div class="float-right">
                                <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Añadir') }}  <!-- Boton  añadir -->
                                </a>
                                <a href="{{ route('clients.pdf') }}" class="btn btn-primary btn-sm" data-placement="left">
                                    {{ __('Descargar PDF') }} <!-- Boton Descargar PDF-->
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
                                        <th>Id</th>
                                        
									<th >Nombre</th>
									<th >Apellido</th>
									<th >Direccion</th>         <!-- Titulos de las Filas -->
									<th >Telefono</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                        <td >{{ $client->id }}</td>
										<td >{{ $client->name }}</td>
										<td >{{ $client->lastname }}</td> <!-- Parte Logica de los datos de las Columnas order referenciando datos creados  en las tablas -->
										<td >{{ $client->addres }}</td>     <!--  ($client elemento de client)-> adress(referencia dato de direccion de cliente -->
										<td >{{ $client->phone }}</td>

                                            <td>
                                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('clients.show', $client->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a> <!-- Boton Mostrar Show -->
                                                    <a class="btn btn-sm btn-success" href="{{ route('clients.edit', $client->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>    <!-- Boton  Editar Edit -->
                                                    @csrf
                                                    @method('DELETE')
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
                {!! $clients->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
