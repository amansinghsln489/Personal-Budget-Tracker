<?php

namespace App\Http\Controllers\Lead;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\User\Role;
use App\Models\Company\Company;
use App\Models\Company\Technology;
use Illuminate\Support\Str;
use App\Models\Lead\Lead;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead\LeadStatus;
use App\Models\Lead\LeadHistory;
use Illuminate\Support\Facades\Auth;

class LeadCommentController extends Controller
{
    public function show(Lead $lead)
    {
        $leadData = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])
        ->where('leads.id', '=', $lead->id)
        ->first();

        // $leadData = Lead::select(
        //     'leads.*',
        //     'leads.created_at as lead_created_at',
        //     'companies.*',
        //     'users.firstname as candidate_firstname',
        //     'users.lastname as candidate_lastname',
        //     'users.role as candidate_role',
        //     'technologies.technology_name',
        //     'interviewers.firstname as interviewer_firstname',
        //     'interviewers.lastname as interviewer_lastname',
        // )
        // ->leftJoin('companies', 'leads.company_id', '=', 'companies.company_id')
        // ->leftJoin('users', 'leads.vendor_id', '=', 'users.user_id')
        // ->leftJoin('users as interviewers', 'leads.interviewee_id', '=', 'interviewers.user_id')
        // ->leftJoin('technologies', 'leads.technology_id', '=', 'technologies.technology_id')
        // ->where('leads.id', '=', $lead->id)
        // ->first(); // Retrieve only one record

        // Fetch lead histories
        $leadHistories = LeadHistory::where('lead_id', $lead->id)
        ->orderBy('created_at', 'ASC')
        ->with('leadStatus')
        ->with('user') // Load the user relationship
        ->get();
        // echo"<pre>";
        // print_r($leadHistories);
        // die;
            
        return view('lead.show-lead', compact('leadData', 'leadHistories'));
    } 

    public function store(Request $request)
    {
      
        // Validate incoming request data as needed
        $request->validate([
            'lead_id' => 'required|int',
            'lead_comment' => 'required|string',
           
        ]);
     
        $leadId = $request->input('lead_id');;
      
        $leadData = Lead::find($leadId);
        $interview_status = $leadData->interview_status;

        // Update the lead comment in the database
        $lead = Lead::findOrFail($request->input('lead_id'));
        $lead->lead_comment = $request->input('lead_comment');
        $lead->save();
        // echo "Hello";
        // die;
        // Get the logged-in user's name and role
        $user = Auth::user();
        $userName = $user->firstname . ' ' . $user->lastname;
        $userId = $user->user_id;
        $roleName = Role::find($user->role)->role_name;
        // Insert data into LeadHistory table
        $leadHistory = new LeadHistory();
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
