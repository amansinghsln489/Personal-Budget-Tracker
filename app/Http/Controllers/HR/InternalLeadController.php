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
use Illuminate\Support\Facades\Storage;




class InternalLeadController extends Controller
{
    public function index(Request $request)
    {
        $query = InternalLead::with(['leadStatus','intervieweeName','userName']);
        $leadStatuss = LeadStatus::all();
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $interviewStatus = $request->input('status');
        
        if (!empty($interviewStatus)){
            $query->where('status', $interviewStatus);

            if (!empty($start_date) && !empty($end_date)) {
                $query->whereBetween('created_at', [$start_date, $end_date]);
            }
            
        }
        $candidates = $query->get();

        $selectedValues = [
           
            'interview_status' => $interviewStatus,
        ];

        return view('HrInternalLead.internal-leads-index', compact('candidates','leadStatuss','selectedValues'));
       
    }
    public function create()
    {
        $technologies = Technology::all();
        $leadStatuss = LeadStatus::all();
       
        $experiences = Experience::all();
        $users = User::where('role', 3)->get();
        
        return view('HrInternalLead.internal-leads-create', compact('technologies','leadStatuss','experiences','users'));
   
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $userId = $user->user_id;
        $userName = $user->firstname . ' ' . $user->lastname;
        $roleName = Role::find($user->role)->role_name;

       
    $errors = [
        'candidate_email.unique' => 'The email has already been taken.',
        'candidate_mobile.unique' => 'The mobile number already exists.',
    ];

    // Validate the request data
    $validatedData = $request->validate([
        'candidate_name' => 'required|string',
        'candidate_email' => 'required|email|unique:internal_leads,candidate_email',
        'candidate_mobile' => 'required|digits:10|unique:internal_leads,candidate_mobile',
        'interview' => 'required|string',
        'technology_id' => 'required|string',
        'interview_date' => 'required|string',
        'experience' => 'required|string',
        'status' => 'required|string'
        // Add validation rules for other fields as needed
    ], $errors);
       
        // $resumePath = null;
        // if ($request->hasFile('user_resume')) {
        //     // Validate the resume file
        //     if ($request->file('user_resume')->isValid()) {
        //         $resumePath = $request->file('user_resume')->store('resumes', 'public');
        //     } else {
        //         throw new \Exception('Invalid resume file.');
        //     }
        // }
        $resumePath = null;
        if ($request->hasFile('user_resume')) {
            // Validate the resume file
            if ($request->file('user_resume')->isValid()) {
                // Sanitize the candidate name to be used in the file path
                $candidateName = preg_replace('/[^A-Za-z0-9\-]/', '_', $request->input('candidate_name'));
                
                // Generate a unique file name
                $fileName = $candidateName . '_' . time() . '.' . $request->file('user_resume')->getClientOriginalExtension();
                
                // Store the resume in the 'resumes' directory within 'public' storage, with the customized file name
                $resumePath = $request->file('user_resume')->storeAs('resumes', $fileName, 'public');
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
        if ($request->hasFile('user_resume')) {
            // Validate the image file
            if ($request->file('user_resume')->isValid()) {
                $candidateName = preg_replace('/[^A-Za-z0-9\-]/', '_', $request->input('candidate_name'));
                
                // Generate a unique file name
                $fileName = $candidateName . '_' . time() . '.' . $request->file('user_resume')->getClientOriginalExtension();
                
                // Store the resume in the 'resumes' directory within 'public' storage, with the customized file name
                $imagePath = $request->file('user_resume')->storeAs('resumes', $fileName, 'public');
              
                // Optionally, delete the old image file if it exists
                if ($internal_lead->resume){
                    Storage::disk('public')->delete($internal_lead->resume);
                }
    
                // Update the user's image path
                $internal_lead->resume = $imagePath;
            } else {
                throw new \Exception('Invalid image file.');
            }
        }
        if (!empty($imagePath)) {
            $internal_lead->resume = $imagePath;
            $internal_lead->save();
        }
       
        $internal_lead->update([
            'candidate_name' => $request->input('candidate_name'),
            'candidate_email' => $request->input('candidate_email'),
            'candidate_mobile' => $request->input('candidate_mobile'),
            'interviewee_id' => $request->input('interview'),
            'candidate_interview_feedback' =>  $request->input('candidate_interview_feedback'),
            'interview_date' => $request->input('interview_date'),
            'status' => $request->input('status'),
            'technology_id' => $request->input('technology_id'),
            'experience' => $request->input('experience'),
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
        return redirect()->route('internal-leads.index')->with('success', 'Candidate updated successfully');
    }
    
    
    public function destroy(InternalLead $internal_lead)
    {
        // Your code to remove a specific internal lead from the database
    }
    
        public function checkEmail(Request $request)
    {
        $email = $request->input('candidate_email');
        $mobile = $request->input('candidate_mobile');
        $emailExists = InternalLead::where('candidate_email', $email)->exists();
        $mobileExists = InternalLead::where('candidate_mobile', $mobile)->exists();
        return response()->json([
            'email_exists' => $emailExists,
            'mobile_exists' => $mobileExists
        ]);

        
       
       
    }
    
}
