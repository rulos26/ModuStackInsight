@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">📄 Mis Documentos</h1>
                    <a href="{{ route('documents.upload') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        📤 Subir Nuevo
                    </a>
                </div>

                @if($documents->count() > 0)
                    <div class="grid gap-4">
                        @foreach($documents as $document)
                            <div class="border rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $document->filename }}</h3>
                                        <p class="text-sm text-gray-600">
                                            Subido: {{ $document->created_at->format('d/m/Y H:i') }}
                                        </p>
                                        <div class="flex items-center mt-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($document->status === 'completed') bg-green-100 text-green-800
                                                @elseif($document->status === 'processing') bg-yellow-100 text-yellow-800
                                                @elseif($document->status === 'failed') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                @switch($document->status)
                                                    @case('completed') ✅ Completado @break
                                                    @case('processing') ⏳ Procesando @break
                                                    @case('failed') ❌ Error @break
                                                    @default ⏸️ Pendiente @break
                                                @endswitch
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        @if($document->status === 'completed')
                                            <a href="{{ route('documents.show', $document) }}"
                                               class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                                                Ver Resúmenes
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">📄</div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No tienes documentos aún</h3>
                        <p class="text-gray-600 mb-4">Sube tu primer documento para comenzar</p>
                        <a href="{{ route('documents.upload') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            📤 Subir Documento
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
