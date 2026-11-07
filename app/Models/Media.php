<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'type',
        'path',
        'is_validated',
    ];

    public function getUrlAttribute(): string
    {
        return Storage::disk(config('filesystems.media_disk'))->url($this->path);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
