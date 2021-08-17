<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Comment extends Model
{
    use HasFactory;

    protected $table        = 'comments';
    protected $fillable     = ['id','user_id','post_id','parent_id','is_active','comment','created_at','updated_at'];


    public function replies()
    {
        return $this->hasMany(CommentReplies::class)->orderBy('created_at','desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
