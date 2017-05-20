<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'followed_user_id'
    ];


}
