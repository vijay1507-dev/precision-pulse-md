<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnquireForm extends Model
{
       protected $fillable = ['full_name', 'email', 'phone', 'message'];

}
