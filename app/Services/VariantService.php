<?php

namespace App\Services;

use App\Models\Test;
use App\Models\Variant;
use App\Repositories\VariantRepository;

class VariantService
{
    private VariantRepository $variantRepository;

    public function __construct(VariantRepository $variantRepository)
    {
        $this->variantRepository = $variantRepository;
    }

    public function createVariant(Test $test, array $data)
    {
        $data['test_id'] = $test->id;

        return $this->variantRepository->createVariant($data);
    }

    public function findAllVariantsOfTest(Test $test)
    {
        return $this->variantRepository->findAllVariantsOfTest($test->id);
    }

    public function updateVariant(Variant $variant, array $data)
    {
        $variant->update($data);

        return $variant;
    }

    public function deleteVariant(Variant $variant)
    {
        $variant->delete();
    }

    public function getRightAnswersStringArray(Test $test)
    {
        $rightAnswers = $this->variantRepository->getRightAnswers($test->id);
        foreach ($rightAnswers as $rightAnswer) {
            $rightAnswersArray[] = $rightAnswer->value;
        }

        return $rightAnswersArray;
    }
}
