<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @mixin \Eloquent
 */
class Products extends Model
{
    /**
     * @var string
     */
    protected $table = 'productss';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id');
    }
    public function banners()
    {
        return $this->hasMany(ProductBanner::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailImages()
    {
        return $this->hasMany('App\Models\ProductDetailImage', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bannerImages()
    {
        return $this->hasMany('App\Models\ProductBannerImage', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany('App\Models\ProductVideo', 'product_id');
    }
}
