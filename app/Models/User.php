<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'role',
    ];

    /** Two-letter initials for the avatar fallback. */
    public function initials(): string
    {
        return collect(explode(' ', trim($this->name)))->filter()->map(fn ($w) => mb_substr($w, 0, 1))->take(2)->implode('');
    }

    /** Tabs each role may access (admin = all). */
    public const ACCESS = [
        'admin'   => ['dashboard','reservation','rooms','housekeeping','inventory','calendar','invoice','expenses','reviews','concierge','guest-profile'],
        'manager' => ['dashboard','reservation','rooms','housekeeping','inventory','calendar','invoice','expenses','reviews','concierge','guest-profile'],
        'staff'   => ['dashboard','reservation','housekeeping','inventory','calendar','guest-profile'],
    ];

    public function can_access($tab)
    {
        return in_array($tab, self::ACCESS[$this->role] ?? []);
    }

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
