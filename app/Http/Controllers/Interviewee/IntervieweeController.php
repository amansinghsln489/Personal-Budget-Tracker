<?php

namespace App\Http\Controllers\Interviewee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company\Technology;
use App\Models\Interview\Interviewee;
use App\Models\Lead\Lead;
use App\Models\User\User;
use App\Models\Lead\LeadStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Hr\InternalLead;


class IntervieweeController extends Controller
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
                    $leads = InternalLead::with([ 'leadStatus','intervieweeName','userName'])
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
                return view('interviewee.interview_index', compact('userLeadcreators', 'leads', 'LeadStatuss'));
            }
            
      

}
