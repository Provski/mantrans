<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $table    = 'quotes';
    protected $fillable = ['id','user_id','title','content','name','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function post()
    {
        return $this->hasMany(Post::class);
    }

}
