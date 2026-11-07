<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = auth()->user()->products()->with('media')->latest()->get();
        return view('producer.products.index', compact('products'));
    }

    public function create()
    {
        return view('producer.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'videos.*' => 'nullable|mimes:mp4,avi,mov|max:10240',
        ]);

        $product = Product::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'location' => $request->location,
            'price' => $request->price,
        ]);

        $mediaDisk = config('filesystems.media_disk');

        // Upload images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products/images', $mediaDisk);
                Media::create([
                    'product_id' => $product->id,
                    'type' => 'image',
                    'path' => $path,
                ]);
            }
        }

        // Upload videos
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $path = $video->store('products/videos', $mediaDisk);
                Media::create([
                    'product_id' => $product->id,
                    'type' => 'video',
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('producer.products.index')->with('success', 'Produit créé avec succès');
    }

    public function show(Product $product)
    {
        $this->authorize('view', $product);
        $product->load('media', 'comments');
        return view('producer.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $product->load('media');
        return view('producer.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
        ]);

        $product->update($request->all());

        return redirect()->route('producer.products.index')->with('success', 'Produit mis à jour');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        // Delete media files
        $mediaDisk = config('filesystems.media_disk');

        foreach ($product->media as $media) {
            Storage::disk($mediaDisk)->delete($media->path);
            $media->delete();
        }

        $product->delete();

        return redirect()->route('producer.products.index')->with('success', 'Produit supprimé');
    }

    // Client methods
    public function clientIndex(Request $request)
    {
        $query = Product::where('is_validated', true)->with('media', 'user');

        // Recherche par nom de produit
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filtrer par catégorie
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category', $request->category);
        }

        // Filtrer par localisation
        if ($request->has('location') && !empty($request->location)) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $products = $query->latest()->get();
        return view('client.products.index', compact('products'));
    }

    public function clientShow(Product $product)
    {
        $product->load('media', 'user', 'comments');
        return view('client.products.show', compact('product'));
    }

    // Admin methods
    public function adminIndex()
    {
        $products = Product::with('media', 'user')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function validate(Product $product)
    {
        $product->update(['is_validated' => true]);
        return back()->with('success', 'Produit validé');
    }

    public function validateMedia(Media $media)
    {
        $media->update(['is_validated' => true]);
        return back()->with('success', 'Média validé');
    }
}
