<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Test
 */
class TestWithVariantsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'lesson_id' => $this->lesson_id,
            'variants' => VariantResource::collection($this->variants),
        ];
    }
}
