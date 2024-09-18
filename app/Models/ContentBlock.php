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

    protected function content(): Attribute
    {
        return Attribute::make(
            get: fn( $value) => $this->type === ContentTypes::IMAGE ?
                config('services.storage_base_url') . $value : $value
        );
    }
}
