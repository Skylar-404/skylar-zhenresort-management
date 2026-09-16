<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Exact table name from database.
     */
    protected $table = 'user';

    protected $fillable = [
        'username',
        'email',
        'password_hash',
        'full_name',
        'role',
        'permissions',
        'is_active',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'permissions' => 'array',
            'is_active'   => 'boolean',
        ];
    }

    /**
     * Tell Laravel to look at `password_hash` instead of `password`.
     */
    public function getAuthPasswordName(): string
    {
        return 'password_hash';
    }
}
