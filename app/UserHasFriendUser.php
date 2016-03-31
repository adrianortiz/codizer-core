<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHasFriendUser extends Model
{
    protected $table = 'users_has_friend_users';
    protected $primaryKey = 'users_id';
    protected $fillable = ['users_id', 'users_id_friend'];
    public $timestamps = true;
}
