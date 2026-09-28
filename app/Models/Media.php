<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'type',
        'path',
        'is_validated',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
