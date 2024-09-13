<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $content
 * @property $image_url
 * @property $video_url
*/
class ContentBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'image_url',
        'video_url'
    ];
}
