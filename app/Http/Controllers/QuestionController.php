<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionCollection;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::where('product_id', '=', 38194392)->get();

        return response()->json(new QuestionCollection($questions), 200);
    }
}
