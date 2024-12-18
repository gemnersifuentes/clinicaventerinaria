<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datos_Empresa;

class Datos_EmpresaController extends Controller
{
    // Mostrar todos los registros de la empresa
    public function index()
    {
        $empresas = Datos_Empresa::all();
        return view('empresa.index', compact('empresas'));
    }

    // Mostrar el formulario para crear una nueva empresa
    public function create()
    {
        return view('empresa.create');
    }

    // Guardar una nueva empresa en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'ruc_empresa' => 'required|string|max:11',
            'logo_empresa' => 'required|string|max:255',
            'mision_empresa' => 'required|string',
            'vision_empresa' => 'required|string',
        ]);

        Datos_Empresa::create($request->all());
        return redirect()->route('empresa.index')->with('success', 'Empresa creada exitosamente');
    }

    // Mostrar un registro de empresa específico
    public function show($id)
    {
        $empresa = Datos_Empresa::findOrFail($id);
        return view('empresa.show', compact('empresa'));
    }

    // Mostrar el formulario para editar una empresa existente
    public function edit($id)
    {
        $empresa = Datos_Empresa::findOrFail($id);
        return view('empresa.edit', compact('empresa'));
    }

    // Actualizar los datos de una empresa existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'ruc_empresa' => 'required|string|max:11',
            'logo_empresa' => 'required|string|max:255',
            'mision_empresa' => 'required|string',
            'vision_empresa' => 'required|string',
        ]);

        $empresa = Datos_Empresa::findOrFail($id);
        $empresa->update($request->all());
        return redirect()->route('empresa.index')->with('success', 'Empresa actualizada exitosamente');
    }

    // Eliminar una empresa existente
    public function destroy($id)
    {
        $empresa = Datos_Empresa::findOrFail($id);
        $empresa->delete();
        return redirect()->route('empresa.index')->with('success', 'Empresa eliminada exitosamente');
    }

    
}



