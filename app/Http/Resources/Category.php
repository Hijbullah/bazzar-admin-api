<?php

namespace App\Http\Resources;

use App\Http\Resources\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image ? Storage::url($this->image) : null,
            'categoryParentsPath' => [ $this->id ],  
            'children' => $this->children->count() ? $this->transformChildren($this->children) : null,
        ];
    }

    public function transformChildren($categories)
    {
        return $categories->map(function($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'image' => $category->image ? Storage::url($category->image) : null,
                'categoryParentsPath' => [...$category->ancestors->pluck('id'), $category->id],
                'children' => $category->children->count() ? $this->transformChildren($category->children) : null
            ];
        });
    }
}
