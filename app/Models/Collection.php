<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Collection
 * @package App\Models
 * @mixin \Eloquent
 */
class Collection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function products()
    {
        return $this->belongsToMany(\App\Models\Product::class, 'collections', 'id', 'product_id');
    }


}