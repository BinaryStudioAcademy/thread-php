<?php

namespace App\Entity;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Entity
 * @property string $name
 * @property string $nick_name
 * @property string $email
 * @property string $password
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
        'name',
        'nick_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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

    public function changeName(string $name): void
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('User name cannot be empty.');
        }

        $this->attributes['name'] = $name;
    }

    public function changeNickName(string $nickname): void
    {
        if (empty($nickname)) {
            throw new \InvalidArgumentException('User nickname cannot be empty.');
        }

        $this->attributes['nick_name'] = $nickname;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNickName(): string
    {
        return $this->nick_name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
