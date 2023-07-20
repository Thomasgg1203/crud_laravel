@extends('layout/template')

@section('title', 'Editar Alumno | Escuela')

@section('contentenido')

<main>
    <div class="container py-4">
        <h2>Editar alumno</h2>

        {{-- Errores del formulario(cuando se envia info mas hecha) --}}
        @if($errors->any())
            {{-- Codigo alert --}}
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            {{-- Fin codigo alert --}}
        @endif

        <form action="{{ url('alumnos/'. $alumno->id) }}" method="post">
               <!-- Generar un elemento oculto -->
        @method('PUT')
        @csrf
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="matricula">Matricula: </label>
                <div class="col-ms-5">
                    <input type="text" class="form-control" name="matricula" id="matricula" value="{{ $alumno->matricula }}" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="nombre">Nombre Completo: </label>
                <div class="col-ms-5">
                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $alumno->nombre }}" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="fecha">Fecha Nacimiento: </label>
                <div class="col-ms-5">
                    <input type="date" class="form-control" name="fecha" id="fecha" value="{{ $alumno->fecha_nacimeinto }}" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="telefono">Telefono: </label>
                <div class="col-ms-5">
                    <input type="text" class="form-control" name="telefono" id="telefono" value="{{ $alumno->telefono }}" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="email">Email: </label>
                <div class="col-ms-5">
                    <input type="text" class="form-control" name="email" id="email" value="{{ $alumno->email }}">
                </div>
            </div>
            <!-- Parte del select -->
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="nivel">Nivel: </label>
                <div class="col-ms-5">
                    <select name="nivel" id="nivel" class="form-select" required>
                        <option value="">Seleccionar nivel</option> 
                        <!-- Plantillas blade -->
                        @foreach ($niveles as $nivel)
                            <option value="{{ $nivel->id }}"  @if($nivel->id == $alumno->nivel_id) {{ 'selected' }} @endif> {{ $nivel->nombre }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <a href="{{ url('alumnos') }}" class="btn btn-secondary">Regresar</a>
            <button type="submit" class="btn btn-success">Guardar Información</button>

        </form>
    </div>
</main>