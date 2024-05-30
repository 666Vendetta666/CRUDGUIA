<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View //funcion de vista del index client 
    {
        $buscarpor = $request->get('buscarpor');//creacion de elemento del buscador
    
        $query = Client::query(); //datos del modelo cliente
            if ($buscarpor) {
            $query->where(function ($query) use ($buscarpor) {  //se condiciona en que tablas va a buscar la informacion
                $query->where('id', 'like', '%' . $buscarpor . '%')
                      ->orWhere('name', 'like', '%' . $buscarpor . '%')
                      ->orWhere('lastname', 'like', '%' . $buscarpor . '%')
                      ->orWhere('addres', 'like', '%' . $buscarpor . '%') //where (donde)(la tabla) como y usa el buscador
                      ->orWhere('phone', 'like', '%' . $buscarpor . '%');
            });
        }
        $clients = $query->paginate(); //paginar los resultados
        return view('client.index', compact('clients', 'buscarpor')) //retornar a la pagina indice clientes con los datos
            ->with('i', ($request->input('page', 1) - 1) * $clients->perPage());
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View // funcion crea
    {
        $client = new Client(); // creacion elemento cliente nuevo cliente

        return view('client.create', compact('client')); //retornar la vista creacion con los nuevos datos
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request): RedirectResponse // funcion para validar  la informacion guardada
    {
        Client::create($request->validated()); //validacion de la informacion en la creacion de los clientes

        return Redirect::route('clients.index') //retornar a la vista del indice de los clientes
            ->with('Cliente creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View //funcion de la vista mostrar 
    {
        $client = Client::find($id); //encontrar el id en el Modelo CLient

        return view('client.show', compact('client')); // retornar al indice clientes
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View //funcion de la vista editar
    {
        $client = Client::find($id); //encontrar el id en el Modelo CLient

        return view('client.edit', compact('client')); // retornar al indice clientes
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client): RedirectResponse
    {
        $client->update($request->validated());

        return Redirect::route('clients.index')
            ->with('success', 'Client updated successfully');
    }

    public function destroy($id): RedirectResponse // funcion eliminar
    {
        Client::find($id)->delete(); //encontrar y eliminar el id cliente

        return Redirect::route('clients.index') // retornar al indice cliente
            ->with('success', 'Client deleted successfully');
    }
}
