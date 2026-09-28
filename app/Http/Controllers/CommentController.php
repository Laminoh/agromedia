<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'content' => ['required', 'string', 'max:2000'],
        ]);

        $product = Product::where('is_validated', true)->findOrFail($validated['product_id']);

        Comment::create([
            'user_id' => $request->user()->id,
            'product_id' => $product->id,
            'rating' => $validated['rating'],
            'content' => $validated['content'],
        ]);

        return redirect()
            ->route('client.products.show', $product)
            ->with('success', 'Votre commentaire a été envoyé et sera visible après validation.');
    }
}
