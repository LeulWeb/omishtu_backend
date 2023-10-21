<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
     protected $fillable= [
        'title',
'slug',
'summary',
'image',
'description',
'is_top',
'label',
'link',
     ];

     protected $casts =[
          'label'=>'array'
     ];
}
