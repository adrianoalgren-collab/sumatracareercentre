<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'document' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        $file = $request->file('document');
        $path = $file->store('documents', 'public');

        $document = $request->user()->documents()->create([
            'name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);

        return response()->json([
            'id' => $document->id,
            'name' => $document->name,
            'url' => $document->url,
            'icon' => $document->icon,
        ]);
    }

    public function destroy(Request $request, Document $document)
    {
        abort_unless($document->user_id === $request->user()->id, 403);

        Storage::disk('public')->delete($document->file_path);
        $document->delete();

        return response()->json(['deleted' => true]);
    }
}