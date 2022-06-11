<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::with(['questions', 'reviews'])->find(38194392);
        $product['photos'] = json_decode($product['photos']);
        $product['videos'] = json_decode($product['videos']);
        $product['category'] = json_decode($product['category']);

        return response()->json(new ProductResource($product), 200);
    }
}
