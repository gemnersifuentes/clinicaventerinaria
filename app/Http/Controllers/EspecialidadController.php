<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
   
        public function index(){
            $Especialidades = Especialidad::get();
            return view('Especialidades.index',compact('Especialidades'));
        }
        public function create(){
            return view('Especialidades.create');
        }
        public function store(Request $request){
            
            $Especialidad = new Especialidad();
            $Especialidad->nombre = $request->nombre;
            $Especialidad->descripcion = $request->descripcion;
            $Especialidad->codigo = $request->codigo;
            $Especialidad->estado = $request->estado;
            $Especialidad->save();
            return redirect('/Especialidades');
        }
        public function edit($id){
            // Obtener una sola especialidad por su ID
            $Especialidades = Especialidad::findOrFail($id); // Esto devuelve un solo modelo
        
            return view('Especialidades.edit', compact('Especialidades'));
        }
        
        public function update($id,Request $request){
            $Especialidad = Especialidad::find($id);
            $Especialidad->nombre = $request->nombre;
            $Especialidad->descripcion = $request->descripcion;
            $Especialidad->codigo = $request->codigo;
            $Especialidad->estado = $request->estado;
            $Especialidad->update();
            return redirect('/Especialidades');
        }
        public function destroy($id){
            $Especialidad = Especialidad::find($id);
            $Especialidad->delete();
            return redirect('/Especialidades');
        }
    }

