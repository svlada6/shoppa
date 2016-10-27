<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
        'body', 
        'author_id', 
        'category_id', 
        'meta_title', 
        'meta_tags', 
        'meta_description', 
        'post_type',
        'slug',
        'order'
    ];


    /**
     * Get the user that owns the post.
     */
    public function author()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * Get the category that owns the post.
     */
    public function getCategory()
    {
        return $this->belongsTo('App\PostCategory');
    }

    /**
     * Post has one link
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function links()
    {
        return $this->hasOne(Link::class);
    }

    /**
     * Check if link is present
     *
     * @return string
     */
    public function checkLink()
    {
        return $this->links ? $this->links->links_to : '';
    }
}
