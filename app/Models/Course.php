<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected  $fillable =[

'title',
'description',
'image',
'students',
'lessons',
'projects',
'days',
'is_visible',
'icons',

    ];


    protected $casts=[
        'icons'=>'array'
    ];

    public function chapters(): HasMany{
        return $this->hasMany(Chapter::class);
    }

    public  function  courseEnrollments(){
        return $this->hasMany(CourseEnrollment::class);
    }
}
