<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    protected $fillable = ['user_id', 'name', 'file_path', 'mime_type', 'size'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::url($this->file_path),
        );
    }

    protected function icon(): Attribute
    {
        return Attribute::make(
            get: fn () => match (true) {
                str_contains($this->mime_type ?? '', 'pdf') => 'picture_as_pdf',
                str_contains($this->mime_type ?? '', 'word') => 'description',
                default => 'insert_drive_file',
            },
        );
    }
}