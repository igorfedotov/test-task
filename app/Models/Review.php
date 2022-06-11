<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'author', 'text', 'grade', 'response_author', 'response_text', 'created_at', 'resp_created_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
