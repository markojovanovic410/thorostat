<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "email_verified_at",
        "password",
        "avatar",
        "phone",
        "user_type",
    ];
}
