<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\RoleTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int id
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string password
 * @property string avatar_url
 */
class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, RoleTrait;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'avatar_url',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value !== null ?
                config('services.storage_base_url').$value : null
        );
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class)
            ->using(CourseStudent::class)
            ->withPivot('lesson_id', 'is_completed', 'test_result');
    }
}
