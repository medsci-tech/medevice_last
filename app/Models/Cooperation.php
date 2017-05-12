<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BeanLog
 * @package App\Models
 * @mixin \Eloquent
 */
class Cooperation extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'user_id',
        'real_name',
        'contact_phone',
        'join_type',
    ];
    public function products()
    {
        return $this->belongsToMany(\App\Models\Product::class, 'cooperations', 'id', 'product_id');
    }

}