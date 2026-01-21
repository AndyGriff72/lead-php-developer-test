<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'prefixname',
        'firstname',
        'middlename',
        'lastname',
        'username',
        'email',
        'password',
        'photo',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    /**
     * Create full name string from first, middle and last names.
     *
     * @return string Returns a concatenated string comprising user's name fields.
     */
    public function fullname(): string {
        return collect([
            $this->firstname,
            $this->middlename,
            $this->lastname,
        ])->filter()->join(' ');
    }

    /**
     * Get user's middle initial.
     *
     * @return string Returns capitalized middle initial from middlename property.
     */
    public function middleinitial(): string {
        return $this->middlename ? strtoupper(substr($this->middlename, 0, 1)) : '';
    }

    /**
     * Get the user's avatar URL.
     *
     * @return
     */
    public function avatar(): ?string {
        return $this->photo ? url(Config::get('users.avatarPath') . $this->photo) : null;
    }

    /**
     * Get linked details records.
     *
     * @return HasMany Returns the one-to-many relationship object.
     */
    public function details(): HasMany {
        return $this->hasMany(Detail::class);
    }
}
