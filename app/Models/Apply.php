<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $hidden = ['updated_at','created_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'real_name',
        'sex',
        'phone',
        'unit',
        'depart',
        'intention',
    ];

}
