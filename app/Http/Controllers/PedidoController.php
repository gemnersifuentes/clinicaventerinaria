<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(){
        $pedidos = Pedido::get();
        return view('pedidos.index', compact('pedidos'));
    }
    public function create(){
        return view('pedidos.create');
    }
    public function store(Request $request){
        $pedido = new Pedido();
        $pedido->numero = $request->numero;
        $pedido->fecha = $request->fecha;
        $pedido->save(); // Guardar el pedido en la base de datos
        return redirect()->route('pedidos.index'); // Redirigir a la lista de pedidos
    }
    

    public function edit($id){
        $pedido = Pedido::Find($id);
        return view('pedidos.edit', compact('pedido'));
    }

    public function update(Request $request,$id){
        $pedido = Pedido::find($id);
        $pedido->numero = $request->numero;
        $pedido->fecha = $request->fecha;
        $pedido->update();
        return redirect('/pedidos');
    }

    public function destroy($id){
        $pedido = Pedido::find($id);
        $pedido->delete();
        return redirect('/pedidos');
    }
}
