<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hr\InternalLead;
use App\Models\Company\Technology;
use App\Models\Lead\LeadStatus;
use App\Models\Interview\Interviewee;
use Illuminate\Support\Facades\Auth;
use App\Models\User\User;
use App\Models\Hr\InternalLeadDetail;
use App\Models\User\Role;
use App\Models\Company\Experience;




class InternalLeadController extends Controller
{
    public function index()
    {
        $candidates = InternalLead::with(['leadStatus','intervieweeName','userName'])->get();
        return view('HrInternalLead.internal-leads-index', compact('candidates'));
    }
    public function create()
    {
        $technologies = Technology::all();
        $leadStatuss = LeadStatus::all();
        $interview_names = Interviewee::all();
        $experiences = Experience::all();
        $users = User::where('role', 3)->get();
        
        return view('HrInternalLead.internal-leads-create', compact('technologies','leadStatuss','interview_names','experiences','users'));
   
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $userId = $user->user_id;
        $userName = $user->firstname . ' ' . $user->lastname;
        $roleName = Role::find($user->role)->role_name;

        $request->validate([
            'candidate_name' => 'required|string',
            'candidate_email' => 'required|email|unique:internal_leads,candidate_email',
            'candidate_mobile' => 'required|string',
            'interview' => 'required|string',
            'technology_id' => 'required|string',
            'interview_date' => 'required|string',
            'experience' => 'required|string',
            'status' => 'required|string'

            // Add validation rules for other fields as needed
        ]);

        $resumePath = null;
        if ($request->hasFile('user_resume')) {
            // Validate the resume file
            if ($request->file('user_resume')->isValid()) {
                $resumePath = $request->file('user_resume')->store('resumes', 'public');
            } else {
                throw new \Exception('Invalid resume file.');
            }
        }
      
        $internalLead = InternalLead::create([
            'candidate_name' => $request->input('candidate_name'),
            'candidate_email' => $request->input('candidate_email'),
            'candidate_mobile' => $request->input('candidate_mobile'),
            'resume' => $resumePath,
            'interviewee_id' => $request->input('interview'),
            'experience' => $request->input('experience'),
            'technology_id' => $request->input('technology_id'),
            'created_by' => $userId,
            'candidate_interview_feedback' => $request->input('candidate_interview_feedback'),
            'interview_date' => $request->input('interview_date'),
            'status' => $request->input('status'),
            'additional_comments' => $request->input('additional_comments'),
        ]);

        $lastCreatedId = $internalLead->id;
        $candidate_interview_feedback = $request->input('candidate_interview_feedback');

        if(!empty($candidate_interview_feedback)){

// Insert data into LeadHistory table
        $leadHistory = new InternalLeadDetail();
        $leadHistory->lead_id = $lastCreatedId;
        $leadHistory->comment =$request->input('candidate_interview_feedback');
        $leadHistory->interview_status = $request->input('status');
        $leadHistory->leadCreate_user_Id = $userId;
        $leadHistory->leadCreate_user_name = $userName;
        $leadHistory->leadCreate_user_role = $roleName;
        $leadHistory->save();
        }

        
    
        return redirect()->route('internal-leads.index')->with('success', 'Candidate created successfully.');
    }

    public function show( $internal_lead)
    {
        
        $leadHistories = InternalLeadDetail::where('lead_id',$internal_lead)
        ->orderBy('created_at', 'ASC')
        ->with(['InternalLead','leadStatus', 'userName'])
        // Load the user relationship
        ->get();
        $leadDatas = InternalLead::with(['leadStatus', 'intervieweeName', 'userName','technology','experienceYear'])
        ->where('id','=', $internal_lead)
        ->get();
         
        return view('HrInternalLead.internal-leads-view',compact('leadDatas','leadHistories'));


    }

    public function edit(InternalLead $internal_lead)
    {
        $leadStatuss = LeadStatus::all();
        $experiences = Experience::all();
        $technologies = Technology::all();
        $interview_names = User::where('role', 3)->get();
        return view('HrInternalLead.internal-leads-edit',compact('internal_lead','leadStatuss','interview_names','experiences','technologies'));
    }

    public function update(Request $request, InternalLead $internal_lead)
    {
        $user = Auth::user();
        $userId = $user->user_id;
        $userName = $user->firstname . ' ' . $user->lastname;
        $roleName = Role::find($user->role)->role_name;
    
        $request->validate([
            'candidate_name' => 'required|string',
            'candidate_email' => 'required|email',
            'candidate_mobile' => 'required|string',
           
        ]);
    
        $internal_lead->update([
            'candidate_name' => $request->input('candidate_name'),
            'candidate_email' => $request->input('candidate_email'),
            'candidate_mobile' => $request->input('candidate_mobile'),
            'interviewee_id' => $request->input('interview'),
            'candidate_interview_feedback' =>  $request->input('candidate_interview_feedback'),
            'interview_date' => $request->input('interview_date'),
            'status' => $request->input('status'),
            'technology_id' => $request->input('technology_id'),
            'additional_comments' => $request->input('additional_comments'),
        ]);
    
        // Get the ID of the updated internal lead
        $lastCreatedId = $internal_lead->id;
        $candidate_interview_feedback = $request->input('candidate_interview_feedback');
        
        if(!empty($candidate_interview_feedback)){
        // Insert data into InternalLeadDetail table
        $leadHistory = new InternalLeadDetail();
        $leadHistory->lead_id = $lastCreatedId;
        $leadHistory->comment = $request->input('candidate_interview_feedback'); 
        $leadHistory->interview_status = $request->input('status');
        $leadHistory->leadCreate_user_Id = $userId;
        $leadHistory->leadCreate_user_name = $userName;
        $leadHistory->leadCreate_user_role = $roleName;
        $leadHistory->save();
        }
    
        // Redirect back with success message
        return redirect()->route('internal-leads.index')->with('success', 'Internal Lead updated successfully');
    }
    

    public function destroy(InternalLead $internal_lead)
    {
        // Your code to remove a specific internal lead from the database
    }
}
