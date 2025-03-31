<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function add() : object
    {
        return view('addProduct');
    }

    public function store(Request $request) : object
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $product = Product::query()->create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'profile_id' => Session::get('user')->id
            ]);

            // Обработка фотографий
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $photo) {
                    $photoData = $photo->store('photos', 'public');

                    Photo::query()->create([
                        'path' => $photoData,
                        'product_id' => $product->id,
                    ]);
                }
            }
        });

        return redirect('/profile/' . Session::get('user')->id);
    }
}
