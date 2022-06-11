<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'product_id', 'name', 'photo', 'text', 'answer', 'created_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
