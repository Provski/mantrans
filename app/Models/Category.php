<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Category extends Model
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
                'source'        => 'category',
                'onUpdate'      => true,
            ]
        ];
    }

    protected $table    = 'categories';
    protected $fillable = ['id','user_id','category','post_category','about_category','created_at','updated_at','slug'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function post()
    {
        return $this->hasMany(Post::class);
    }


    public function getCategoryImageAttribute($value)
    {
        return asset('images'.$value);
    }

}


