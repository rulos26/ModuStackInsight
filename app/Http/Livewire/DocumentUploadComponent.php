<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ProcessDocumentJob;
class DocumentUploadComponent extends Component
{
    use WithFileUploads;

    public $file;

    protected $rules = [
        'file' => 'required|file|mimes:pdf|max:102400', // max 100MB aprox
    ];

    public function upload()
    {
        $this->validate();

        $filename = $this->file->getClientOriginalName();
        $path = $this->file->store('documents', 'public'); // almacenamiento local

        $document = Document::create([
            'user_id' => Auth::id(),
            'filename' => $filename,
            'path' => $path,
            'status' => 'pending',
        ]);

        // Opcional: dispatch Job para procesar IA
        // ProcessDocumentJob::dispatch($document);

        session()->flash('message', 'Documento subido correctamente. Procesamiento pendiente.');

        $this->reset('file');
        ProcessDocumentJob::dispatch($document);
    }

    public function render()
    {
        return view('livewire.document-upload-component');
    }
}
