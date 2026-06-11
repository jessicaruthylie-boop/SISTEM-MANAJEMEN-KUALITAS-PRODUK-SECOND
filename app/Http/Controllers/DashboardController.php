<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $recommendations = Product::inRandomOrder()->limit(5)->get();
        return view('dashboard', compact('recommendations'));
    }
}