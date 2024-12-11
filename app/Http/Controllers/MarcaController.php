<?php

namespace App\Http\Controllers;

use App\Models\Marca;



use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        // Obtener todas las marcas
        $marcas = Marca::all();

        return view('admin.marcas.index', compact('marcas'));
    }
    public function create()
    {
        // Obtener todas las marcas
        $marcas = Marca::all();

        return view('admin.marcas.create', compact('marcas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
        ]);

        Marca::create($request->all());

        return redirect()->route('marcas.index')->with('success', 'Marca creada exitosamente');
    }

    public function edit(Marca $marca)
    {
        $marcas = Marca::all();

        return view('admin.marcas.edit', compact('marca', 'marcas'));
    }

    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
        ]);

        $marca->update($request->all());

        return redirect()->route('marcas.index')->with('success', 'Marca actualizada');
    }

    public function destroy(Marca $marca)
    {
        $marca->delete();

        return redirect()->route('marcas.index')->with('success', 'Marca eliminada');
    }
}
