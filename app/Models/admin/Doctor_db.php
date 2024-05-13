<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor_db extends Model
{
    use HasFactory;
    protected $table = 'doctor_db';
    public $timestamps = false;
}
