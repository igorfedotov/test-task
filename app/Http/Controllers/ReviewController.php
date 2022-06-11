<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewCollection;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public  function index()
    {
        $reviews = Review::where('product_id', '=', 38194392)->get();

        return response()->json(new ReviewCollection($reviews), 200);
    }
}
