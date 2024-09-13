<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $title
 * @property $estimation
*/
class Lesson extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'estimation',
        'course_id'
    ];
}
