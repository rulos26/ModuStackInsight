<?php
namespace App\Jobs;

use App\Models\Document;
use App\Models\DocumentSummary;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProcessDocumentJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function handle()
    {
        try {
            $this->document->update(['status' => 'processing']);

            // Simular procesamiento (sin PDF Parser por ahora)
            $filename = $this->document->filename;
            $text = "Contenido simulado del documento: {$filename}";

            // 3️⃣ Generar resúmenes (simulación)
            $summaries = [
                'executive' => $this->generateSummary($text, 'executive'),
                'technical' => $this->generateSummary($text, 'technical'),
                'detailed'  => $this->generateSummary($text, 'detailed'),
            ];

            // 4️⃣ Guardar resúmenes en DB
            foreach ($summaries as $type => $content) {
                DocumentSummary::create([
                    'document_id' => $this->document->id,
                    'summary_type' => $type,
                    'content' => $content,
                ]);
            }

            $this->document->update(['status' => 'completed']);
        } catch (\Exception $e) {
            $this->document->update(['status' => 'failed']);
            \Log::error('Error procesando documento: '.$e->getMessage());
        }
    }

    private function generateSummary(string $text, string $type): string
    {
        // Aquí se integraría con OpenAI/Claude o modelo local
        // Ejemplo simulado:
        return strtoupper($type).' SUMMARY: '.substr($text, 0, 500).'...';
    }
}
