<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   use Sluggable;

   protected $fillable = [
       'title', 'image', 'body', 'iframe', 'user_id'
   ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function getGetExcerptAttribute()
    {
        return substr($this->body, 0, 20);
    }

    public function getGetImageAttribute()
    {
        if($this->image){
            return url("storage/{$this->image}");
        }
    }

}
