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
use App\Models\Vendor\Vendor;


class LeadController extends Controller
{
    public function showLeadForm()
    {
        $vendors = Vendor::with('technology')
        ->orderBy('name')
        ->get();

        $interviewee_users = User::select('users.*', 'roles.role_name')
        ->leftJoin('roles', 'users.role', '=', 'roles.role_id')
        ->where('users.role', 3)
        ->orderBy('firstname')
        ->orderBy('lastname')
        ->get();
        $LeadStatuss = LeadStatus::where('leadstatusstatus', 1)->get();
        
        $leads = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])->get();
        
        $companies = Company::where('company_status', 1)->orderBy('company_name')->get();

        $technologies = Technology::where('technology_status', 1)->get();
             
        return view('lead.add-lead', compact('companies','technologies','vendors','interviewee_users','leads', 'LeadStatuss'));
    }

    public function index()
    {
        $user = Auth::user();
        $userName = $user->firstname . ' ' . $user->lastname;
        $loggedinUserId = $user->user_id;
        $loggedinUserRole = $user->role;

     if($loggedinUserRole == 3){
        $leads = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])
        ->where('interviewee_id', $loggedinUserId)
        ->get();
        $LeadStatuss = LeadStatus::where('leadstatusstatus', 1)->get();
        return view('lead.view-lead', compact('leads', 'LeadStatuss'));
     

     }else{
        $LeadStatuss = LeadStatus::where('leadstatusstatus', 1)->get();

        $leads = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])->get();

        return view('lead.view-lead', compact('leads', 'LeadStatuss'));
     }

      
    }

    public function searchLeads(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $interviewStatus = $request->input('interview_status');
    
        $fromDate = Carbon::createFromFormat('d-m-Y', $fromDate)->startOfDay();
        $toDate = Carbon::createFromFormat('d-m-Y', $toDate)->endOfDay();
    
        $leadsQuery = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])
            ->whereBetween('created_at', [$fromDate, $toDate]);
    
        if ($interviewStatus) {
            $leadsQuery->where('interview_status', $interviewStatus);
        }
    
        // Get the filtered leads
        $leads = $leadsQuery->get();
    
        $LeadStatuss = LeadStatus::where('leadstatusstatus', 1)->get();
    
        $selectedValues = [
            'from_date' => $fromDate->format('d-m-Y'),
            'to_date' => $toDate->format('d-m-Y'),
            'interview_status' => $interviewStatus,
        ];
    
        return view('lead.view-lead', compact('leads', 'LeadStatuss', 'selectedValues'));
    }

    public function updateReadStatus(Request $request, Lead $lead)
    {
        $lead->update(['is_read' => $request->is_read]);
        return response()->json(['success' => true]);
    }

    
  
}
