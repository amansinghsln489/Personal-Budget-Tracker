<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lead\LeadStatus;
use App\Models\Interview\Interviewee;

class InternalLead extends Model
{
    use HasFactory;
    protected $table = 'internal_leads';
    protected $fillable = [
        'candidate_name', // Add candidate_name to the $fillable array
        'candidate_email',
        'candidate_mobile',
        'candidate_interview_feedback',
        'interview_date',
        'interviewee_id',
        'status',
        'additional_comments',
    ];
    public function leadStatus()
    {
        return $this->belongsTo(LeadStatus::class, 'status');
    }
    public function intervieweeName()
    {
        return $this->belongsTo(Interviewee::class, 'interviewee_id');
    }
}
