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

class DashboardController extends Controller
{

    public function index()
    {
        $today = Carbon::today();

        $firstDayOfMonth = Carbon::now()->startOfMonth();

        // Fetch users where the role is 4 Sales Team
        $users = User::where('role', 4)->get();

        // Iterate through users and add count of leads created by each user
        foreach ($users as $user) {
            $todayLeadCount = Lead::where('lead_created_user_id', $user->user_id)
                ->whereDate('created_at', $today)
                ->count();

            $monthLeadCount = Lead::where('lead_created_user_id', $user->user_id)
                ->where('created_at', '>=', $firstDayOfMonth)
                ->count();

            $user->todayLeadCount = $todayLeadCount;
            $user->monthLeadCount = $monthLeadCount;
        }

        $interviewees = User::where('role', 3 )->get();

        // interviewee

        // Iterate through users and add count of leads created by each user for interviee
        foreach ($interviewees as $interviewee) {

            $todayInterviewCount = Lead::where('interviewee_id', $interviewee->user_id)
            ->whereDate('interview_date', $today)
            ->count();

            $monthLeadCount = Lead::where('interviewee_id', $interviewee->user_id)
                ->where('created_at', '>=', $firstDayOfMonth)
                ->count();

            $interviewee->monthLeadCount = $monthLeadCount;
            $interviewee->todayInterviewCount = $todayInterviewCount;
        }

        $leads = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])->get();

        return view('dashboard', compact('users', 'interviewees', 'leads'));
    }

}
