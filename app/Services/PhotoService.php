<?php

namespace App\Services;

use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoService
{
    public function create(Request $request, $product) : void
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $photo) {
                $photoData = $photo->store('photos', 'public');

                Photo::query()->create([
                    'path' => $photoData,
                    'product_id' => $product->id,
                ]);
            }
        }
    }

    public function delete(Product $product) : void
    {
        $imagePath = $product->photos;

        if ($imagePath != null) {
            foreach ($imagePath as $photo) {
                if (Storage::disk('public')->exists($photo->path)) {
                    Storage::disk('public')->delete($photo->path);
                }
            }
        }
    }
}
