<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductVideo
 * @package App\Models
 * @mixin \Eloquent
 */
class ProductVideo extends Model
{
    /**
     * @var string
     */
    protected $table = 'product_videoss';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Products', 'product_id');
    }
}
