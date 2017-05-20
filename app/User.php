<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use DB;
use App\Post;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * relation to itself
     * it will give all the users whom are followed by the current user
     */
    public function followed_users()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'followed_user_id');
    }

    /**
     * relation to itself
     * it will give all the followers of the current user
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'followed_user_id', 'user_id');
    }

    /**
     * relation to post table
     * user has many post
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * to get the latest feed of the current user
     */
    public function getFeed()
    {
        $self = Post::where('user_id', '=', $this->id);

        return Post::
            join('followers', 'posts.user_id', '=', 'followers.followed_user_id')
            ->where('followers.user_id', '=', $this->id)
            ->select('posts.*')
            ->unionAll($self)
            ->latest()
            ->limit(10)
            ->with('user')
            ->get();
    }


}
