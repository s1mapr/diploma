<?php

namespace App\Repositories;

use App\Models\ContentBlock;

class ContentBlockRepository
{
    public function createContentBlock(array $data)
    {
        return ContentBlock::create($data);
    }
}
