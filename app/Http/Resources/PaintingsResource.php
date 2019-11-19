<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaintingsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($painting) {
                return [
                    'id' => $painting->id,
                    'name' => $painting->name,
                    'painter' => $painting->painter
                ];
            }),
        ];
    }
}
