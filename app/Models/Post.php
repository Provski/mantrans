<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
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
                'source'        => 'title',
                'onUpdate'      => true,
            ]
        ];
    }
    
    protected $table        = 'posts';
    protected $fillable     = ['id','user_id','author_id','category_id','quote_id','comment_id','title','post_image','body','figure','figure_caption','created_at','updated_at'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function getPostImageAttribute($value)
    // {
    //     return asset('images'.$value);
    // }
    
    public function author()
    {
        return $this->belongsTo(Author::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at','desc')->where('is_active',1);
    }

}
