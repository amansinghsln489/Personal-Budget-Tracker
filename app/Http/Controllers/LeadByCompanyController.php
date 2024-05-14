<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Lead\Lead;
use App\Models\User\User;
use App\Models\User\Role;
use App\Models\Company\Company;
use App\Models\Company\Technology;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead\LeadStatus;
use App\Models\Lead\LeadHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor\Vendor;


class LeadByCompanyController extends Controller
{
    public function index(Request $request)
    {
        $companyId = $request->input('company_id');

        $leads = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'leadStatus'])
        ->where('company_id', $companyId)
        ->get();
        //         $leads = Lead::select(
        //         'leads.*',
        //         'leads.created_at as lead_created_at',
        //         'companies.*',
        //         'users.firstname as candidate_firstname',
        //         'users.lastname as candidate_lastname',
        //         'users.role as candidate_role',
        //         'interviewers.firstname as interviewer_firstname',
        //         'interviewers.lastname as interviewer_lastname',
        //         'lead_statuses.leadstatusname as lead_status'
        //     )
        //     ->leftJoin('companies', 'leads.company_id', '=', 'companies.company_id')
        //     ->leftJoin('users', 'leads.candidate_id', '=', 'users.user_id')
        //     ->leftJoin('users as interviewers', 'leads.interviewee_id', '=', 'interviewers.user_id')
        //     ->leftJoin('lead_statuses', 'leads.interview_status', '=', 'lead_statuses.leadstatusid')
        //     ->where('leads.company_id', $companyId)
        //     ->get();

        return response()->json($leads);
    }
}
