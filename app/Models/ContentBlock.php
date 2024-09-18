<?php

namespace App\Models;

use App\Enums\ContentTypes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $content
 * @property $type
*/
class ContentBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'type',
        'lesson_id'
    ];

    protected $casts = [
        'type' => ContentTypes::class,
    ];

    protected function imageUrl(): Attribute
    {
        $type = $this->type;
        return Attribute::make(
            get: fn(?string $value) => $value !== null ?
                config('services.storage_base_url') . $value : null
        );
    }
}
