<!-- resources/views/monitor/pruebas/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Prueba</h1>
    <form method="POST" action="{{ route('admin.usuarios.store') }}" id="form-prueba" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="id_tipo_prueba">Tipo de Prueba</label>
            <select class="form-control" id="id_tipo_prueba" name="id_tipo_prueba" required>
                @foreach ($tiposPrueba as $tipoPrueba)
                    <option value="{{ $tipoPrueba->id_tipo_prueba }}">{{ $tipoPrueba->nombre_tipo_prueba }}</option>
                @endforeach
            </select>
        </div>

        <!-- Campo para cargar archivo JSON -->
        <div class="form-group" id="json-input" style="display: none;">
            <label for="archivo_json">Archivo JSON</label>
            <input type="file" class="form-control-file" id="archivo_json" name="archivo_json" accept=".json">
        </div>

        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('id_tipo_prueba').addEventListener('change', function() {
        const tipoPrueba = this.value;
        const jsonInput = document.getElementById('json-input');
        const form = document.getElementById('form-prueba');
        
        if (tipoPrueba == 1) { // ID del tipo de prueba 'archivo'
            jsonInput.style.display = 'block';
            form.action = "{{ route('monitor.pruebas.cargar-json') }}";
        } else if (tipoPrueba == 2) { // ID del tipo de prueba 'random'
            jsonInput.style.display = 'none';
            form.action = "{{ route('monitor.pruebas.cargar-random') }}";
        }
    });

    // Asegúrate de que el campo se muestre correctamente al cargar la página si el tipo de prueba es "archivo"
    document.addEventListener('DOMContentLoaded', function() {
        const tipoPrueba = document.getElementById('id_tipo_prueba').value;
        if (tipoPrueba == 1) {
            document.getElementById('json-input').style.display = 'block';
        }
    });
</script>
@endpush