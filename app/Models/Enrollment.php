<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Enrollment extends Model
{
    use HasFactory;



    protected $fillable= [
        'student_id',
        'total_price'
    ];

    public function student(): BelongsTo{
        return $this->belongsTo(Student::class);
    }

    
    
    public  function  courseEnrollments() : HasMany{
        return  $this->hasMany(CourseEnrollment::class);
    }
    public function getTotalPriceAttribute()
    {
        return $this->courseEnrollments()->sum('unit_price');
    }
}
