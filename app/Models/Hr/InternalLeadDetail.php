<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lead\LeadStatus;
use App\Models\Interview\Interviewee;
use App\Models\User\User;
use App\Models\Company\Technology;
use App\Models\Hr\InternalLead;

class InternalLeadDetail extends Model
{
    use HasFactory;

    protected $table = 'internal_leads_details'; 

    protected $fillable = [
        'lead_id',
        'comment',
        'interview_status',
        'leadCreate_user_Id',
        'leadCreate_user_name',
        'leadCreate_user_role'
    ];
    public function InternalLead()
    {
        return $this->belongsTo(InternalLead::class, 'lead_id');
    }

    public function leadStatus()
    {
        return $this->belongsTo(LeadStatus::class, 'interview_status');
    }
    public function userName()
    {
        return $this->belongsTo(User::class, 'leadCreate_user_Id');
    }
  

}
