<!-- resources/views/monitor/pruebas/crear-json.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cargar Prueba desde JSON</h1>
    <form method="POST" action="{{ route('monitor.pruebas.cargar-json') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="archivo_json">Archivo JSON</label>
            <input type="file" class="form-control-file" id="archivo_json" name="archivo_json" accept=".json" required>
        </div>
        <button type="submit" class="btn btn-primary">Cargar</button>
    </form>
</div>
@endsection