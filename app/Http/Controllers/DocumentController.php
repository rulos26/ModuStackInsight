<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Jobs\ProcessDocumentJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function showUploadForm()
    {
        return view('documents.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:102400', // max 100MB
        ]);

        $filename = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->store('documents', 'public');

        $document = Document::create([
            'user_id' => Auth::id(),
            'filename' => $filename,
            'path' => $path,
            'status' => 'pending',
        ]);

        // Procesar documento en background
        ProcessDocumentJob::dispatch($document);

        return redirect()->back()->with('message', 'Documento subido correctamente. Procesamiento en curso...');
    }

    public function index()
    {
        $documents = Document::with('summaries')->where('user_id', Auth::id())->latest()->get();
        return view('documents.index', compact('documents'));
    }

    public function show(Document $document)
    {
        // Verificar que el usuario puede ver este documento
        if ($document->user_id !== Auth::id() && !Auth::user()->hasRole('superadmin')) {
            abort(403);
        }

        $document->load('summaries');
        return view('documents.show', compact('document'));
    }
}
