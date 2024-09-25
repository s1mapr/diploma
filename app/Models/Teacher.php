<?php

namespace App\Models;

use App\Traits\RoleTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
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
    use HasFactory, HasApiTokens, RoleTrait;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'password'
    ];
}
