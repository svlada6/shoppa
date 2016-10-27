<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Plan extends Model
{
    protected $table = 'plans';

    protected $fillable = [
        'name',
        'cups_amount',
        'price_per_cup',
        'discount',
        'price',
        'featured_image',
        'enabled',
        'shipping_plan',
    ];

    /**
     * Sanitize image name
     *
     * @param  $image
     * @return string
     */
    public static function sanitize($image)
    {
//        $uniqueId = uniqid();

        $name = str_slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME), '_');
        $ext = str_slug((pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION)));
//        $name = $uniqueId . $name . '.' . $ext;
        $name = $name . '.' . $ext;

        return $name;
    }

    /**
     * Store sanitized image and
     * delete previous uploaded one
     *
     * @param  int $id
     * @param  object $file
     * @return string
     */
    public static function storeImage($id, $file)
    {
        $destinationPath = 'uploads/plans/' . $id . '/';

        $imageName = static::sanitize($file);
        File::deleteDirectory($destinationPath, true);
        $file->move($destinationPath, $imageName);

        return $imageName;
    }
}
