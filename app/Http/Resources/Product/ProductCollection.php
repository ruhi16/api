<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;//Collection;

class ProductCollection extends Resource//Collection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        // return "hello";
        // return parent::toArray($request);        
        return[
            'name' => $this->name,
            // 'description'   => $this->detail,
            // 'price' => $this->price,
            // 'stock' => $this->stock == 0 ? 'No Stock Exists' : $this->stock,
            'discount'  => $this->discount,
            'totalPrice'=> round((1 - ($this->discount/100)) * $this->price, 2),
            'rating'    => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(), 2) : 'No Rating Yet!!!',
            'href'  =>[
                'reviews' => route('products.show', $this->id)
            ]
        ];
    }
}
