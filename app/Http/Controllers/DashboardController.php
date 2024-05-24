<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\Lead\Lead;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User\Role;
use App\Models\Company\Company;
use App\Models\Company\Technology;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead\LeadStatus;
use App\Models\Lead\LeadHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\Hr\InternalLead;

class DashboardController extends Controller
{

    public function index()
    {
//         $userTimeInput = "2024-05-25 10:00:00";
//         $currentServerTime = Carbon::now();
//         $userTime = Carbon::createFromFormat('Y-m-d H:i:s', $userTimeInput);
        
//         if ($currentServerTime < $userTime) {
//         $timeDifferenceInHours = $currentServerTime->diffInHours($userTime);
//         $timeDifferenceInMinutes = $currentServerTime->diffInMinutes($userTime) % 60;
        
      
//         $currentIndianTime = $currentServerTime->copy()->setTimezone('Asia/Kolkata');
        
//         // Display the results in Indian date and time format
//         echo "Current Indian time: " . $currentIndianTime->format('d-m-Y H:i:s') . "\n";
//         echo "User time: " . $userTime->format('d-m-Y H:i:s') . "\n";
//         echo "Difference: " . $timeDifferenceInHours . " hours and " . $timeDifferenceInMinutes . " minutes\n";
//         }
//         else{
//             echo "invlaid";
//         }
// die;

// =========================================================================================
        $today = Carbon::today();

        $firstDayOfMonth = Carbon::now()->startOfMonth();
        // Fetch users where the role is 4 Sales Team
        $users = User::where('role', 2)->get();

        foreach ($users as $user) {
            $todayLeadCount = InternalLead::where('created_by',$user->user_id)
                ->whereDate('created_at', $today)
                ->count();
                
            $monthLeadCount = InternalLead::where('created_by', $user->user_id)
                ->where('created_at', '>=', $firstDayOfMonth)
                ->count();
               
            $user->todayLeadCount = $todayLeadCount;
            $user->monthLeadCount = $monthLeadCount;
        }
        $interviewees = User::where('role', 3)->get();
    
        // Iterate through users and add count of leads created by each user for interviee
        foreach ($interviewees as $interviewee) {
            $interviewCounts = InternalLead::selectRaw(
                'COUNT(*) as total_interviews, 
                 SUM(CASE WHEN DATE(created_at) = ? THEN 1 ELSE 0 END) as today_interviews',
                [$today]
            )->where('interviewee_id', $interviewee->user_id)
              ->first();
        
            $interviewee->total_interviews = $interviewCounts->total_interviews;
            $interviewee->today_interviews = $interviewCounts->today_interviews;
        
            $monthLeadCount = InternalLead::where('interviewee_id', $interviewee->user_id)
                ->where('created_at', '>=', $firstDayOfMonth)
                ->count();
        
            $interviewee->monthLeadCount = $monthLeadCount;
        }
        $interview_data = InternalLead::where('created_by', $user->user_id)
        ->get();

        // echo"<pre>";
        // print_r($interview_data); die;
        $leads = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])->get();
        
        $totalInterviews = InternalLead::select(
            'technology_id',
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) as selected_total'),
            DB::raw('SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) as unselected_total')
        )
        ->groupBy('technology_id')
        ->with('technology') // Eager load the technology relationship
        ->get();
    
        return view('dashboard', compact('users', 'interviewees', 'leads','totalInterviews'));
    }

}
