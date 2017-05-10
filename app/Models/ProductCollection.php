<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductCollection
 * @package App\Models
 * @mixin \Eloquent
 */
class ProductCollection extends Model
{
    /**
     * @var string
     */
    protected $table = 'product_collections';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'customer_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
}
