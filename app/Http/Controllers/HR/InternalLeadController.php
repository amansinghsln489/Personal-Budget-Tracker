<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hr\InternalLead;
use App\Models\Company\Technology;
use App\Models\Lead\LeadStatus;
use App\Models\Interview\Interviewee;


class InternalLeadController extends Controller
{
    public function index()
    {
        // $candidates = InternalLead::all(); 

        $candidates = InternalLead::with(['leadStatus','intervieweeName'])->get();

        // $cand = InternalLead::with('intervieweeName')->get();
        // Retrieve all internal leads from the database
        echo "<pre>";
        print_r($candidates);
        die;


        return view('HrInternalLead.internal-leads-index', compact('candidates'));
    }
    public function create()
    {
        $technologies = Technology::where('technology_status', 1)->get();
        $leadStatuss = LeadStatus::all();
        $interview_names = Interviewee::all();
        
        return view('HrInternalLead.internal-leads-create', compact('technologies','leadStatuss','interview_names'));
   
    }

    public function store(Request $request)
    {
        $request->validate([
            'candidate_name' => 'required|string',
            'candidate_email' => 'required|email|unique:internal_leads,candidate_email',
            'candidate_mobile' => 'required|string',
            // Add validation rules for other fields as needed
        ]);
        
        InternalLead::create([
            'candidate_name' => $request->input('candidate_name'),
            'candidate_email' => $request->input('candidate_email'),
            'candidate_mobile' => $request->input('candidate_mobile'),
            'interviewee_id' => $request->input('interview'),
            'candidate_interview_feedback' => $request->input('candidate_interview_feedback'),
            'interview_date' => $request->input('interview_date'),
            'status' => $request->input('status'),
            'additional_comments' => $request->input('additional_comments'),
        ]);
    
        return redirect()->route('internal-leads.index')->with('success', 'Candidate created successfully.');
    }

    public function show(InternalLead $internal_lead)
    {
        // Your code to display the details of a specific internal lead
    }

    public function edit(InternalLead $internal_lead)
    {
        $leadStatuss = LeadStatus::all();
        return view('HrInternalLead.internal-leads-edit',compact('internal_lead','leadStatuss'));
    }

    public function update(Request $request, InternalLead $internal_lead)
    {
        $request->validate([
            'candidate_name' => 'required|string',
            'candidate_email' => 'required|email',
            'candidate_mobile' => 'required|string',
            // Add validation rules for other fields as needed
        ]);
        $internal_lead->update([
            'candidate_name' => $request->input('candidate_name'),
            'candidate_email' => $request->input('candidate_email'),
            'candidate_mobile' => $request->input('candidate_mobile'),
            'candidate_interview_feedback' => $request->input('candidate_interview_feedback'),
            'interview_date' => $request->input('interview_date'),
            'status' => $request->input('status'),
            'additional_comments' => $request->input('additional_comments'),
        ]);

        // Redirect back with success message
        return redirect()->route('internal-leads.index')->with('success', 'Interanal Lead updated successfully');
       
    }

    public function destroy(InternalLead $internal_lead)
    {
        // Your code to remove a specific internal lead from the database
    }
}
