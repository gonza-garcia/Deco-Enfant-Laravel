<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return ['name'           => $this->name,
                'short_desc'     => $this->short_desc,
                'long_desc'      => $this->long_desc,
                'price'          => $this->price,
                'thumbnail'      => $this->thumbnail,
                'stock'          => $this->stock,
                'discount'       => $this->discount,
                'color_id'       => $this->color_id,
                'size_id'        => $this->size_id,
                'subcategory_id' => $this->subcategory_id,
               ];
    }
}
