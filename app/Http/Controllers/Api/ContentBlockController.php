<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateContentBlockRequest;
use App\Http\Resources\ContentBlockResource;
use App\Models\ContentBlock;
use App\Services\ContentBlockService;

class ContentBlockController extends Controller
{

    private ContentBlockService $contentBlockService;

    public function __construct(ContentBlockService $contentBlockService)
    {
        $this->contentBlockService = $contentBlockService;
    }

    public function getContentBlockData(ContentBlock $contentBlock)
    {
        return $this->success([
            'content_block' => ContentBlockResource::make($contentBlock)
        ]);
    }

    public function deleteContentBlock(ContentBlock $contentBlock)
    {
        $this->contentBlockService->deleteContentBlock($contentBlock);
        return $this->successWithoutData('Content block deleted successfully');
    }

    public function updateContentBlock(UpdateContentBlockRequest $request, ContentBlock $contentBlock)
    {
        $this->contentBlockService->updateContentBlock($contentBlock, $request->validated());
        return $this->successWithoutData('Content block updated successfully');
    }
}
