<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
            'description' => $this->description,
            'status' => $this->status,
            'favorite' => $this->favorite,
            'isCotton' => $this->is_cotton,
            'photos' => $this->photos,
            'videos' => $this->videos,
            'salePercent' => $this->sale_percent,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'questions' => new QuestionCollection($this->questions),
            'reviews' => new ReviewCollection($this->reviews)
        ];
    }
}
