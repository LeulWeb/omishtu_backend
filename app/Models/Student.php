<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
       'full_name',
'profile',
'email',
'gender',
'phone',
'occupation',
'education',
'city',
'sub_city',
'wereda'
    ];
}
