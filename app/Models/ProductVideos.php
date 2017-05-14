<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductSpecification
 * @package App\Models
 * @mixin \Eloquent
 */
class ProductVideos extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_videos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'qcloud_app_id',
        'qcloud_file_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}