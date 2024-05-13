<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthInsurance extends Model
{
    use HasFactory;
    protected $table = 'health_insurance_agen';
    public $timestamps = false;
}
