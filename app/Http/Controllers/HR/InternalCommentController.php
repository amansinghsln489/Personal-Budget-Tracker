<?php
namespace App\Http\Controllers\HR;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\User\Role;
use App\Models\Company\Company;
use App\Models\Company\Technology;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead\LeadStatus;
use App\Models\Lead\LeadHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\Hr\InternalLead;
use App\Models\Hr\InternalLeadDetail;

class InternalCommentController extends Controller
{
   
    public function store(Request $request)
    {
       // Validate incoming request data as needed
        $request->validate([
            'lead_id' => 'required|int',
            'lead_comment' => 'required|string',
           
        ]);
        $leadId = $request->input('lead_id');
        $leadData = InternalLead::find($leadId);
        $interview_status = $leadData->technology_id;
        
        // Update the lead comment in the database
        $lead = InternalLead::findOrFail($request->input('lead_id'));
        $lead->candidate_interview_feedback = $request->input('lead_comment');
        $lead->save();
       
        // Get the logged-in user's name and role
        $user = Auth::user();
        $userName = $user->firstname . ' ' . $user->lastname;
        $userId = $user->user_id;
        $roleName = Role::find($user->role)->role_name;
        // Insert data into LeadHistory table
        $leadHistory = new InternalLeadDetail();
        $leadHistory->lead_id = $request->input('lead_id');
        $leadHistory->comment = $request->input('lead_comment'); 
        $leadHistory->interview_status = $interview_status;

        // Set the logged-in user's name and role
        $leadHistory->leadCreate_user_Id = $userId;
        $leadHistory->leadCreate_user_name = $userName;
        $leadHistory->leadCreate_user_role = $roleName;

        $leadHistory->save();
        return redirect()->back()->with('success', 'Comment added successfully');
    }
}
