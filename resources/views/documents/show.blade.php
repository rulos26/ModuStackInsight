@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $document->filename }}</h1>
                        <p class="text-sm text-gray-600">
                            Subido: {{ $document->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                    <a href="{{ route('documents.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        ← Volver
                    </a>
                </div>

                @if($document->summaries->count() > 0)
                    <div class="grid gap-6">
                        @foreach($document->summaries as $summary)
                            <div class="border rounded-lg p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-4 capitalize">
                                    @switch($summary->summary_type)
                                        @case('executive') 📊 Resumen Ejecutivo @break
                                        @case('technical') 🔧 Resumen Técnico @break
                                        @case('detailed') 📋 Resumen Detallado @break
                                        @default {{ ucfirst($summary->summary_type) }} @break
                                    @endswitch
                                </h3>
                                <div class="prose max-w-none">
                                    <p class="text-gray-700 whitespace-pre-wrap">{{ $summary->content }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">⏳</div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Procesando documento...</h3>
                        <p class="text-gray-600">Los resúmenes estarán disponibles pronto</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
