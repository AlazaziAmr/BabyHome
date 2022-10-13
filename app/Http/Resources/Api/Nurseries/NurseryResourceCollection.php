<?php

namespace App\Http\Resources\Api\Nurseries;


use Illuminate\Http\Resources\Json\ResourceCollection;

class NurseryResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'links' => [
                'self' => $this->count(),
            ],
        ];
    }
}
