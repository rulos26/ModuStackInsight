<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'summary_type',
        'content',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
