<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage; 
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View //funcion del index con buscador 
    {
        $buscarpor = $request->get('buscarpor');//se crea el elemento del buscador
        $query = Order::query();
        if ($buscarpor) { //se condiciona en que tablas va a buscar la informacion
            $query->where(function ($query) use ($buscarpor) {
                $query->where('id', 'like', '%' . $buscarpor . '%')
                      ->orWhere('client_id', 'like', '%' . $buscarpor . '%') //where (donde)(la tabla) como y usa el buscador
                      ->orWhere('items', 'like', '%' . $buscarpor . '%')
                      ->orWhere('brands', 'like', '%' . $buscarpor . '%')
                      ->orWhere('amounts', 'like', '%' . $buscarpor . '%')
                      ->orWhere('prices', 'like', '%' . $buscarpor . '%');
            });
        }
        $orders = $query->paginate();
        $i = ($orders->currentPage() - 1) * $orders->perPage();

        return view('order.index', compact('orders', 'buscarpor')) // retornar  la vista del index order con los elementos de orders y el buscador
            ->with('i', ($request->input('page', 1) - 1) * $orders->perPage());
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View // funcion crear
    {
        $order = new Order();
        $client = Client::pluck('id','name'); //seleccionador del cliente segun su nombre
        return view('order.create', compact('order','client')); //retornar la vista creacion con los elementos de pedidos y clientes
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request): RedirectResponse // funcion para validar  la informacion guardada
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {   //condicion para verificar si tiene imagen
            $path = $request->file('image')->store('order_images', 'public'); //almacenar la imagen en la carpeta order.images
            $validatedData['image'] = $path; 
        }
        Order::create($validatedData); // crear un registro
        return Redirect::route('orders.index') // retornar a la pagina de index order
            ->with('success', 'Pedido creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View //funcion de mostrar vista del pedido 
    {
        $order = Order::find($id);

        return view('order.show', compact('order')); //retornar a la vista mostrar 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View   //funcion de editar orden 
    {
        $order = Order::find($id);  //encontrar id cliente
        $client = Client::pluck('id','name');  //seleccionador nombre del cliente
        return view('order.edit', compact('order','client')); // retornar con los fatos actualizados
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(OrderRequest $request, Order $order): RedirectResponse
{
    $validatedData = $request->validated(); //verificar y validar  datos

    if ($request->hasFile('image')) { //condicion que si existe una imagen eliminarla
        if ($order->image) {
            Storage::disk('public')->delete($order->image); //eliminar de la carpeta storage
        }
        $validatedData['image'] = $request->file('image')->store('order_images', 'public'); // almacenar la nueva imagen en la carpeta storage
    }
    $order->update($validatedData); // actualizar los datos con la nueva imagen
    return Redirect::route('orders.index')      //retonar a al index de pedidos 
        ->with('success', 'Pedido actualizado correctamente.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse // funcion para eliminar un pedido en order
    {
        Order::find($id)->delete(); //eliminar el id del pedido (eliminar pedido)

        return Redirect::route('orders.index')  //retornar  al index order 
            ->with('success', 'Pedido eliminado correctamente.');
    }
}