<?php

declare(strict_types=1);

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use InvalidArgumentException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Entity
 * @property int $id
 * @property string $name
 * @property string $nickname
 * @property string $email
 * @property string $password
 * @property string|null $profile_image
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 */
final class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'nickname',
        'email',
        'password',
        'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function changeFirstName(string $firstName): void
    {
        if (empty($firstName)) {
            throw new InvalidArgumentException('User first_name cannot be empty.');
        }

        $this->attributes['first_name'] = $firstName;
    }
    
    public function changeLastName(string $lastName): void
    {
        if (empty($lastName)) {
            throw new InvalidArgumentException('User last_name cannot be empty.');
        }

        $this->attributes['last_name'] = $lastName;
    }

    public function changeNickName(string $nickname): void
    {
        if (empty($nickname)) {
            throw new InvalidArgumentException('User nickname cannot be empty.');
        }

        $this->attributes['nick_name'] = $nickname;
    }

    public function changeAvatar(string $avatarUrl): void
    {
        if (empty($avatarUrl)) {
            throw new InvalidArgumentException('User avatar cannot be empty.');
        }

        $this->attributes['profile_image'] = $avatarUrl;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getNickName(): string
    {
        return $this->nickname;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAvatar(): ?string
    {
        return $this->profile_image;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function tweets(): HasMany
    {
        return $this->hasMany(Tweet::class, 'author_id');
    }
}
