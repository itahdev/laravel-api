<?php

namespace App\Models;

use App\Enums\UserStatus;
use App\Models\Relationships\ClientUserRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

/**
 * @property UserStatus $status
 */
class ClientUser extends Authenticatable implements JWTSubject
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        ClientUserRelationship,
        SoftDeletes,
        Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'name',
        'email',
        'password',
        'phone_number',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'status' => UserStatus::class,
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
