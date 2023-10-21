<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        "course_id",
"start_date",
'end_date',
'unit_price',
'status',
'payment_status',
'paid_amount'
    ];

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
