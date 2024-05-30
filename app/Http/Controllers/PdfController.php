<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Order;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class PdfController extends Controller
{
    public function generatePdf() // funcion del generador pdf 
    {
        $clients = Client::all(); //tomar todo del modelo cliente
        $orders = Order::all(); //tomar todo del modelo pedido order

        $pdf = new Dompdf(); //usar doompdf
        $pdf->loadHtml(view('pdf.report', compact('clients', 'orders'))->render()); //cargar un html con la vista pdfreport. con client order y renderisar.
        $pdf->setPaper('A4', 'landscape'); // tamaño y horientacion 
        $pdf->render();// rendereizar pdf
        
        return $pdf->stream('report.pdf');// retornar el pdf para ser descargado 
    }
}

