<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];


    // this is the function that will be called when a new user doesnt have any profile picture
    public function profileImage()
    {
        // needs to return either the default or the submitted profile image
        $imagePath = ($this->image) ? $this->image : 'profile/rppD92ZaYAzLRXMbfNeAxaKKasRuDtNB08O5bHNx.png';
        return '/storage/' . $imagePath;
    }

    public function followers()
    {
        // a Profile can have Many Users that follow it. So User has many followers()
        return $this->belongsToMany(User::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
