<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpec extends Model
{
    use HasFactory;
    protected $table = 'doctor_specialities';
    public $timestamps = false;
}
