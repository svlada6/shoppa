<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVendor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_vendors';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}