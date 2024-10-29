<?php

namespace App\Models;

use App\Traits\RoleTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property $id
 * @property $email
 * @property $first_name
 * @property $last_name
 * @property $password
 * @property $avatar_url
 */
class Teacher extends Authenticatable
{
    use HasApiTokens, HasFactory, RoleTrait;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'password',
        'avatar_url',
    ];

    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value !== null ?
                config('services.storage_base_url').$value : null
        );
    }
}
