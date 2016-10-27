<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'collections';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'featured_image',
        'meta_title',
        'meta_tags',
        'meta_description',
        'slug',
    ];
    

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
}