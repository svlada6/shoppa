<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $name = 'links';

    protected $fillable = ['link_name', 'links_to', 'parent_id', 'link_type_id'];

    /**
     * Link belongs to post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
