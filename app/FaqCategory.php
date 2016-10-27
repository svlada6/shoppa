<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq_categories';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name',
    ];


    /**
     * Get the faqs for the category post.
     */
    public function getFaqList()
    {
        return $this->hasMany('App\Faq');
    }
   
}