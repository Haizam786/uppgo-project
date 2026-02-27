<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'student',
        'progress',
        'overall_grade',
        'active',
        'deleted',
        'users_id',
        'progress_report_number',
        'examination_date',
        'result_published_date',
        'obtained_total_marks',
        'average_letter_grade',
        'total_gpa',
        'position_in_class',
        'notes',
        'enrolment_number'
    ];

    // You can define relationships or additional logic here

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function getProgressArrayAttribute()
    {
        return json_decode($this->progress, true);
    }
}
