<?php

namespace App\Models\Lead;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company\Company;
use App\Models\Company\Technology;
use App\Models\User\User;
use App\Models\Vendor\Vendor;


class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        // Other fillable fields here,
        'is_read',
    ];

    public function leadHistories()
    {
        return $this->hasMany(LeadHistory::class);
    }

    public function leadStatus()
    {
        return $this->belongsTo(LeadStatus::class, 'interview_status', 'leadstatusid');
    }

    public static function countLeadsCreatedByUser($userId)
    {
        return self::where('lead_created_user_id', $userId)->count();
    }
    // ========================
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // Define the relationship with the User model for candidate
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    // Define the relationship with the User model for interviewer
    public function interviewer()
    {
        return $this->belongsTo(User::class, 'interviewee_id');
    }

    // Define the relationship with the User model for interviewer
    public function createdUser()
    {
        return $this->belongsTo(User::class, 'lead_created_user_id');
    }

    // Define the relationship with the Technology model
    public function technology()
    {
        return $this->belongsTo(Technology::class, 'technology_id');
    }

}
