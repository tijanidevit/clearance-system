<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function student() : HasOne {
        return $this->hasOne(Student::class)->latestOfMany();
    }

    public function stages() : HasMany {
        return $this->hasMany(Stage::class, 'moderator_id');
    }

    public function scopeModerator($query) {
        return $query->whereRole(UserRoleEnum::MODERATOR->value);
    }

    public function isAdmin() : bool {
        return auth()->user()->role == UserRoleEnum::ADMIN->value;
    }

    public function isModerator() : bool {
        return auth()->user()->role == UserRoleEnum::MODERATOR->value;
    }

    public function isStudent() : bool {
        return auth()->user()->role == UserRoleEnum::STUDENT->value;
    }
}
