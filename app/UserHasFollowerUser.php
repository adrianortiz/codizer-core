<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserHasFollowerUser
 *
 * @mixin \Eloquent
 */
class UserHasFollowerUser extends Model
{
    protected $table = 'users_has_follower_users';
    protected $primaryKey = 'users_id';
    protected $fillable = ['users_id', 'users_id_followers'];
    public $timestamps = true;
}
