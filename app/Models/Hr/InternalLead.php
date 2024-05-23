<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lead\LeadStatus;
use App\Models\Interview\Interviewee;
use App\Models\User\User;
use App\Models\Company\Technology;
use App\Models\Company\Experience;

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
        'technology_id',
        'created_by',
        'image',
        'resume',
        'status',
        'experience',
        'additional_comments',
    ];
    public function leadStatus()
    {
        return $this->belongsTo(LeadStatus::class, 'status');
    }
    public function intervieweeName()
    {
        return $this->belongsTo(User::class, 'interviewee_id');
    }
    public function userName()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function technology()
    {
        return $this->belongsTo(Technology::class, 'technology_id');
    }
    public function experienceYear()
    {
        return $this->belongsTo(Experience::class, 'experience');
    }
    // public function interviewStatus()
    // {
    //     return $this->belongsTo(Experience::class, 'experience');
    // }
}
