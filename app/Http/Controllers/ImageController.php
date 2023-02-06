<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getImageByIdProduct($id)
    {
        $images = Image::with('products')->where('product_id', $id)->get();
        dd($images);
    }
}