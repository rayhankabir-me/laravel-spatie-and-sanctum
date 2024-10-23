<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'slug'            => $this->slug,
            'description'     => $this->description === null ? '' : $this->description,
            'parent_category' => optional($this->parent_category)->name,
            'status'          => $this->status,
            'parent_id'       => $this->parent_id,
            'thumb'           => $this->thumb,
            'cover'           => $this->cover
        ];
    }
}
