<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sub_name',
        'description',
        'id_type',
        'id_vendor',
        'price',
        'compare_price',
        'stock_keeping_unit',
        'barcode',
        'multiple_options',
        'images',
        'meta_title',
        'meta_tags',
        'meta_description',
        'slug',
        'in_stock',
        'on_offer',
        'visible_at'
    ];


    public function collections()
    {
        return $this->belongsToMany('App\Collection');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Orders');
    }
}