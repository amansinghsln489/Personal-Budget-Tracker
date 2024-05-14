<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead\Lead;
use App\Models\User\User;
use App\Models\Lead\LeadStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class LeadUserController extends Controller
{
    public function show($userId)
    {
        $today = Carbon::today()->toDateString(); 

        // Find the user by ID Sales Team
        $userLeadcreators = User::findOrFail($userId);
        $LeadStatuss = LeadStatus::where('leadstatusstatus', 1)->get();
        
        /*
        |--------------------------------------------------------------------------
        |  This is applied for the Interview they not see other user data form the url 
        |--------------------------------------------------------------------------
        */
        $current_user = Auth::user();
        if($current_user->role == 3){

            $userId = $current_user->user_id;
            $userLeadcreators = User::findOrFail($userId);

        }
        /*
        |--------------------------------------------------------------------------
        |  For Sales Team
        |--------------------------------------------------------------------------
        */
        if($userLeadcreators->role == 4){
            $leads = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])
            ->where('lead_created_user_id', $userId)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Interviee Team
        |--------------------------------------------------------------------------
        */
        }elseif ($userLeadcreators->role == 3) {  
            $leads = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])
            ->where('interviewee_id', $userId)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | For Adminstator
        |--------------------------------------------------------------------------
        */
        } else {
            $leads = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])
            ->where('lead_created_user_id', $userId)
            ->get();

        }
        return view('user.lead_user', compact('userLeadcreators', 'leads', 'LeadStatuss'));
    }

    public function searchLeads(Request $request, $searchuserId)
    {
        // Initialize selectedValues array
        $selectedValues = [];
        $userLeadcreators = User::findOrFail($searchuserId);
        $leadsQuery = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])
            ->where('lead_created_user_id', $searchuserId);
    
        // Apply additional filters
        if ($request->filled('from_date')) {
            $fromDate = Carbon::createFromFormat('d-m-Y', $request->input('from_date'))->startOfDay();
            $leadsQuery->whereDate('created_at', '>=', $fromDate);
            $selectedValues['from_date'] = $request->input('from_date');
    
            // If "to" date is not provided, set it to the same as the "from" date
            if (!$request->filled('to_date')) {
                $toDate = $fromDate->copy()->endOfDay();
                $selectedValues['to_date'] = $toDate->format('d-m-Y');
            }
        }
    
        if ($request->filled('to_date')) {
            $toDate = Carbon::createFromFormat('d-m-Y', $request->input('to_date'))->endOfDay();
            $leadsQuery->whereDate('created_at', '<=', $toDate);
            $selectedValues['to_date'] = $request->input('to_date');
        }
    
        if ($request->filled('interview_status')) {
            $interviewStatus = $request->input('interview_status');
            $leadsQuery->where('interview_status', $interviewStatus);
            $selectedValues['interview_status'] = $interviewStatus;
        }
    
        // Execute the query to get the filtered leads
        $leads = $leadsQuery->get();
    
        $LeadStatuss = LeadStatus::where('leadstatusstatus', 1)->get();
        return view('user.lead_user', compact('leads', 'LeadStatuss', 'selectedValues', 'userLeadcreators'));
    }
    
    

}
