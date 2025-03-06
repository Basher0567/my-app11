<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable=['fistName','lastName','email','mobile','password'];
    protected $attributes=['otp'=>'0'];
}
