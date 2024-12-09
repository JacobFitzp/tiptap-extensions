<?php

namespace App\Models;

use Github\AuthMethod;
use Github\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'github_id',
        'name',
        'email',
        'avatar',
        'github_token',
        'github_refresh_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'github_token',
        'github_refresh_token',
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
            'github_token' => 'encrypted',
            'github_refresh_token' => 'encrypted',
            'points' => 'integer',
        ];
    }

    /**
     * Has many extensions' relationship.
     */
    public function extensions(): HasMany
    {
        return $this->hasMany(Extension::class);
    }

    /**
     * Get GitHub client instance for this user,
     */
    public function github(): Client
    {
        $client = app(Client::class);
        // Authenticate using the users access token.
        $client->authenticate($this->github_token, authMethod: AuthMethod::ACCESS_TOKEN);

        return $client;
    }
}
