<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Post extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body'
    ];

    /**
     * relation to user table
     * every post belongs to some user
     */
    public function user() {
        return $this->belongsTo(User::class);
    }


}
