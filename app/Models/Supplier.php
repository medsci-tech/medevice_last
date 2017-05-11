<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Supplier
 * @package App\Models
 * @mixin \Eloquent
 */
class Supplier extends Model
{
    /**
     * @var string
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'supplier_id');
    }
}