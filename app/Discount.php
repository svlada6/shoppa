<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'discount_begins', 'discount_ends'];

    /**
     * Mass assignable attributes
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'limit',
        'discount_type',
        'take',
        'discount_extra',
        'discount_begins',
        'discount_ends',
        'never_expires',
        'enabled'
    ];

    protected $appends = ['discount_end_app'];

    public function getDiscountEndAppAttribute()
    {
        return $this->discount_ends ? $this->discount_ends->format('m/d/Y') : null;
    }

    public function getTypes()
    {
        return [
            'usd' => '$ USD',
            'discount' => '% Discount',
            'free_shipping' => 'Free Shipping'
        ];
    }

    public function extraConditions()
    {
        return [
            'all_orders' => 'all orders',
            'orders_over' => 'orders over',
            'collection' => 'collection',
            'specific_product' => 'specific product',
            'customer_in_group' => 'customer in group'
        ];
    }

    /**
     * @return mixed
     */
    public function getBeginDate()
    {
        return $this->discount_begins->toFormattedDateString();
    }

    /**
     * Get Discount end date
     *
     * @param  string $discountEnds
     * @return mixed
     */
    public function discountEnds($discountEnds)
    {
        if ($discountEnds) {
            return $discount_ends = Carbon::createFromFormat('m/d/Y', $discountEnds)->toDateTimeString();
        }

        return $discount_ends = null;
    }

    /**
     * Get discount begin date
     *
     * @param  string $discountStarts
     * @return string
     */
    public function discountStarts($discountStarts)
    {
        $discount_begins = Carbon::createFromFormat('m/d/Y', $discountStarts)->toDateTimeString();

        return $discount_begins;
    }

    /**
     * Format string
     *
     * @param $string
     * @return mixed
     */
    public function formatString($string)
    {
        return str_replace('_', ' ', $string);
    }

    /**
     * Get discount type
     *
     * @param  string $type
     * @return string
     */
    public function checkCode($type)
    {
        $show = '';
        switch ($type) {
            case "usd":
                $show = '$' . $this->take . ' off ' . $this->formatString($this->discount_extra);
                break;

            case "discount":
                $show = '% ' . $this->take . ' off ' . $this->formatString($this->discount_extra);
                break;

            case "free_shipping":
                $show = $this->take . ' off ' . $this->formatString($this->discount_extra);
                break;
        }

        return $show;
    }

}
