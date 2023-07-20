<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Nivel;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('alumno.index', ['alumnos' => Alumno::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //aqui nos toca llamar el modelo
        $niveles = Nivel::all();
        //Envio de la vista 
        return view('alumno.create', ['niveles' => $niveles]);
        //otra opcion:
        //return view('alumno.create', ['niveles' => Nivel::all() ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Parte de validado del formulario

        $request->validate([
            'matricula' => 'required|unique:alumnos|max:10',
            'nombre' => 'required|max:255',
            'fecha' => 'required|date',
            'telefono' => 'required',
            'email' => 'nullable|email',
            'nivel' => 'required'
        ]);
        //Seguimos con la validacion
        $alumno = new Alumno();
        //como envio de info
        $alumno->matricula = $request->input('matricula');
        $alumno->nombre = $request->input('nombre');
        $alumno->fecha_nacimeinto = $request->input('fecha');
        $alumno->telefono = $request->input('telefono');
        $alumno->email = $request->input('email');
        $alumno->nivel_id = $request->input('nivel');
        //funcion para guardar
        $alumno->save();

        return view('alumno.message', ['msg' => "Registro Guardado"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $alumno = Alumno::find($id);
        return view('alumno.edit', ['alumno' => $alumno, 'niveles' => Nivel::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //Parte de validado del formulario

        $request->validate([
            'matricula' => 'required|max:10|unique:alumnos,matricula,'. $id,
            'nombre' => 'required|max:255',
            'fecha' => 'required|date',
            'telefono' => 'required',
            'email' => 'nullable|email',
            'nivel' => 'required'
        ]);
        //Seguimos con la validacion
        $alumno = Alumno::find($id);
        //como envio de info
        $alumno->matricula = $request->input('matricula');
        $alumno->nombre = $request->input('nombre');
        $alumno->fecha_nacimeinto = $request->input('fecha');
        $alumno->telefono = $request->input('telefono');
        $alumno->email = $request->input('email');
        $alumno->nivel_id = $request->input('nivel');
        //funcion para guardar
        $alumno->save();

        return view('alumno.message', ['msg' => "Registro Actualizado"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $alumno = Alumno::find($id);
        $alumno->delete();

        return redirect("alumnos");
    }
}