<?php

namespace App\Http\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Image;
use App\Models\Product;
use App\Services\Product\ProductService;
use App\Trait\ApiResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{
    use ApiResponse;

    private $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(HttpRequest $request)
    {

        if ($request->has('file_upload')) {
            $file = $request->file_upload;
            $file_name = $file->getClientoriginalName();
            $file->move(public_path('images'), $file_name);
        }
        $product = new Product();

        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->description = $request['description'];
        $product->image = $file_name;
        $product->category_id = $request['category_id'];
        $product->save();

        if ($request->has('image_gallery')) {
            foreach ($request->file('image_gallery') as $file) {
                $image_gallery = new Image();
                $name = $file->getClientoriginalName();
                $file->move(public_path('images'), $name);
                $image_gallery->name = $name;
                $image_gallery->is_main_image = 0;
                $image_gallery->product_id = $product->id;
                $image_gallery->save();
            }
        }
        return redirect()->route('list_product');
    }
}