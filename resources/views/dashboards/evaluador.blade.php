@extends('layouts.app')

@section('content')
<div class="container">
    <h1>📑 Dashboard Evaluador</h1>
    <p>Bienvenido <strong>{{ auth()->user()->name }}</strong></p>

    <ul>
        <li>Ver documentos asignados</li>
        <li>Revisar resúmenes generados</li>
        <li>Enviar retroalimentación</li>
    </ul>
</div>
@endsection
