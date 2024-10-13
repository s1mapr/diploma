<?php

namespace App\Http\Resources;

use App\Models\ContentBlock;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ContentBlock
 */
class ContentBlockResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'type' => $this->type,
        ];
    }
}
