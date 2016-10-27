<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'body', 'faq_category_id',
    ];


    /**
     * Get the faq category that owns the faq.
     */
    public function getCategory()
    {
        return $this->belongsTo('App\FaqCategory');
    }
}
