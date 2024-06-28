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
        // $interviewees = User::where('role', 3)->get();
        $interviewees = User::where('role', 3)->paginate(4);
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
        $data = [];
       
        $current_user = Auth::user();
        $userId = $current_user->user_id;
        $interview_dates = InternalLead::
        where('interviewee_id', $userId)
        ->get();
        foreach ($interview_dates as $interview_date) {
            $targetTimeInput = $interview_date->interview_date;
            $timeZone = Carbon::parse($targetTimeInput)->format('d-M-Y h:i:s A');
            
            $currentServerTime = Carbon::now();
          
            if($currentServerTime < $targetTimeInput) {
               
                $timeDifferenceInSeconds = $currentServerTime->diffInSeconds($targetTimeInput);              
                $data[] = [
                    'candidateName' => $interview_date->candidate_name,
                    'timeDifferenceInSeconds' => $timeDifferenceInSeconds,
                    'interviewDate' => $timeZone
                
                ];
            }
        }
        
        
        
        $totalInterviews = InternalLead::select(
            'technology_id',
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) as selected_total'),
            DB::raw('SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) as unselected_total')
        )
        ->groupBy('technology_id')
        ->with('technology') // Eager load the technology relationship
        ->get();
    
        return view('dashboard', compact('users', 'interviewees','totalInterviews','data'));
          
    }
} 
