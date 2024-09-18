<?php

namespace App\Repositories;

use App\Models\Variant;

class VariantRepository
{
    public function createVariant(array $data)
    {
        return Variant::create($data);
    }

    public function findAllVariantsOfTest($id)
    {
        return Variant::where('test_id', $id)->get();
    }
}
