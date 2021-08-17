<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class Author extends Model
{
    use HasFactory;

    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'        => 'author',
                'onUpdate'      => true,
            ]
        ];
    }

    protected $table    = 'authors';
    protected $fillable = ['id','user_id','author','post_author','about_author','introduction','email','nationality','motivation','slug'];
    protected $hidden   = ['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }


    public function getAuthorImageAttribute($value)
    {
        return asset('images'.$value);
    }
}
