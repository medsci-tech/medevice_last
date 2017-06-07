<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Activity
 * @package App\Models
 * @mixin \Eloquent
 */
class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'content'
    ];
/*
* 获取消息对应的用户
*/
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}