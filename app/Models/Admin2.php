<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Admin2 extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticatableTrait;
    protected $table = 'admin2';
    protected $fillable = array('user_name', 'passcode');

}
