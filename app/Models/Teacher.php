<?php

namespace App\Models;

use App\Traits\RoleTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property $id
 * @property $email
 * @property $first_name
 * @property $last_name
 * @property $password
 */
class Teacher extends Authenticatable
{
    use HasApiTokens, HasFactory, RoleTrait;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'password',
    ];
}
