<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Using mutator every time we call method or update password in models we get our password encrypted
    // public function setPasswordAttribute()
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    public function authors()
    {
        return $this->hasMany(Author::class);
    }


    public function category()
    {
        return $this->hasMany(Category::class);
    }


    public function quote()
    {
        return $this->hasMany(Quote::class);
    }


    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    public function userHasRole($role_name)
    {
        foreach($this->roles as $role){
            if(Str::lower($role_name) == Str::lower($role->name))
            return true;
        }
    }

    
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

}
