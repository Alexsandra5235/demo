<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Profile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() : object
    {
        return view('home')
            ->with('products', Product::all())
            ->with('users', Profile::all());
    }
}
