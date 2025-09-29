@extends('layouts.app')

@section('content')
<div class="container">
    <h1>📊 Dashboard Superadmin</h1>
    <p>Bienvenido <strong>{{ auth()->user()->name }}</strong></p>

    <ul>
        <li>Gestión de usuarios</li>
        <li>Gestión de roles y permisos</li>
        <li>Monitoreo general del sistema</li>
        <li>Reportes globales</li>
    </ul>
</div>
@endsection
