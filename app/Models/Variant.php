<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $test_id
 * @property $value
 * @property $is_correct
 */
class Variant extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'value',
        'is_correct'
    ];
}
