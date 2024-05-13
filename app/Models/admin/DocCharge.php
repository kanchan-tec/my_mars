<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocCharge extends Model
{
    use HasFactory;
    protected $table = 'doc_charge';
    public $timestamps = false;
}
