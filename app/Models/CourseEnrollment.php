<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseEnrollment extends Model
{
    use HasFactory;

    public  function  enrollment(): BelongsTo{
        return $this->belongsTo(Enrollment::class);
    }

    public function batch(): BelongsTo{
        return $this->belongsTo(Batch::class);
    }

    public function  course() : BelongsTo{
        return $this->belongsTo(Course::class);
    }
}
