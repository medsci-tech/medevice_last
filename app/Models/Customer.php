<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * @package App\Models
 * @mixin \Eloquent
 */
class Customer extends Model
{
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    public $timestamps = ['created_at', 'updated_at', 'auth_code_expired'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        //return $this->belongsTo(CustomerType::class, 'type_id');
    }

    /**
     * 获取指定用户的所有合作
     */
    public function cooperations()
    {
        return $this->hasMany( \App\Models\Cooperation::class,'user_id');
    }

    /**
     * @return mixed
     */
    public function cooperationsWithProducts()
    {
        return $this->cooperations()->with(['products' => function ($query) {
            $query->get();
        }]);
    }

}
