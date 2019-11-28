<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;


class User extends Authenticatable implements MustVerifyEmailContract
{
    use Notifiable, MustVerifyEmailTrait, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'introduction', 'avatar'
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

    /**
     * Get the topics that posted by the user.
     */
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * Get the replies posted by the user.
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Check whether the user is the author of specific model
     *
     * @param Topic $model
     * @return boolean
     *
     */
    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    /**
     * Eloquent Mutator: Get user's password
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        // If password is encrypted, skip encrypt
        if (strlen($value) != 60) {
            $value = bcrypt($value);
        }

        $this->attributes['password'] = $value;
    }

    public function setAvatarAttribute($path)
    {
        // If the image path doesn't start with 'http', then it should be uploaded via admin panel, a pre-fix is needed.
        if ( ! Str::startsWith($path, 'http')) {
            $path = config('app.url') . "/uploads/images/avatars/$path";
        }

        $this->attributes['avatar'] = $path;
    }
}
