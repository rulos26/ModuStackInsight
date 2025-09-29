@extends('layouts.app')

@section('content')
<div class="container">
    <h1>⚙️ Dashboard Admin</h1>
    <p>Bienvenido <strong>{{ auth()->user()->name }}</strong></p>

    <ul>
        <li>Subir documentos</li>
        <li>Revisar resúmenes</li>
        <li>Ver reportes</li>
    </ul>
</div>
@endsection
