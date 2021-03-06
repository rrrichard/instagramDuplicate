<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
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

    // this gets called when a user registers and the model is called for the first time
    protected static function boot()
    {
        parent::boot();

        // this is the method that gets fired when a user is created
        static::created(function ($user) {
            $user->profile()->create([
                'title' => $user->username,
            ]);
        });
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function following()
    {
        // For this, User can follow Many Profiles. So its following() many Profiles
        return $this->belongsToMany(Profile::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }
}
