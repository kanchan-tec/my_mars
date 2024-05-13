<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitlog extends Model
{
    use HasFactory;
    
    protected $table = 'visitlog';
    public $timestamps = false;
    
    protected $fillable = ['patient_id', 'hospital_id','doctor_id','ch'];
}
