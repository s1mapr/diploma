<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $content
 * @property $lesson_id
 */
class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'content',
    ];
}
