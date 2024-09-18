<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVariantRequest;
use App\Http\Resources\VariantResource;
use App\Models\Variant;
use App\Services\VariantService;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    private VariantService $variantService;

    public function __construct(VariantService $variantService)
    {
        $this->variantService = $variantService;
    }

    public function getVariantData(Variant $variant)
    {
        return $this->success([
            'variant' => VariantResource::make($variant)
        ]);
    }

    public function updateVariant(UpdateVariantRequest $request, Variant $variant)
    {
        $variant = $this->variantService->updateVariant($variant, $request->validated());

        return $this->success([
            'variant' => VariantResource::make($variant)
        ]);
    }

    public function deleteVariant(Variant $variant)
    {
        $this->variantService->deleteVariant($variant);

        return $this->successWithoutData("Variant deleted successfully!");
    }
}
