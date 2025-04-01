<?php

namespace App\Services;

use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductService
{
    public function create(Request $request) : Product
    {
        return Product::query()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'profile_id' => Session::get('user')->id
        ]);
    }

    public function validate(Request $request) : array
    {
        return $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
        ]);
    }

    public function update(Request $request, int $id) : void
    {
        $product = Product::query()->find($id);
        $product->title = $request->input("title");
        $product->description = $request->input("description");
        $product->price = $request->input("price");
        $product->save();
    }
}
