<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProducerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $products = $user->products()->latest()->take(5)->get();
        $orders = $user->ordersAsConsumer()->latest()->take(5)->get();
        
        return view('producer.dashboard', compact('user', 'products', 'orders'));
    }

    public function adminDashboard()
    {
        $totalUsers = User::count();
        $totalProducts = \App\Models\Product::count();
        $pendingProducts = \App\Models\Product::where('is_validated', false)->count();
        $pendingMedia = \App\Models\Media::where('is_validated', false)->count();
        
        return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'pendingProducts', 'pendingMedia'));
    }

    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }
}
