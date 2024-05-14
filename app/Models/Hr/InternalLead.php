<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalLead extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_name', // Add candidate_name to the $fillable array
        'candidate_email',
        'candidate_mobile',
        'candidate_interview_feedback',
        'interview_date',
        'status',
        'additional_comments',
    ];
}
