<!-- resources/views/supervisor/reportes/generar.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Generar Reporte</h1>
    <form method="POST" action="{{ route('supervisor.reportes.generar') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Generar Reporte</button>
    </form>
</div>
@endsection