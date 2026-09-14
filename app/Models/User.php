<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Non-standard singular table name.
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'username',
        'email',
        'password_hash',
        'full_name',
        'role',
        'permissions',
        'is_active',
    ];

    /**
     * Hidden attributes for serialization (arrays / JSON).
     */
    protected $hidden = [
        'password_hash',
    ];

    /**
     * Cast attributes to native types.
     */
    protected function casts(): array
    {
        return [
            'permissions' => 'array',
            'is_active'   => 'boolean',
        ];
    }

    /**
     * Map default Auth system to custom password column.
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}
