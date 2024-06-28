<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Hr\InternalLead;
class SearchController extends Controller
{
    public function search(Request $request)
    {
       
        $query = $request->input('query');
        
        $leads = InternalLead::select(
            'internal_leads.*',
            'internal_leads.created_at as lead_created_at',
            'technologies.technology_name',
            'users.firstname as interviewer_firstname',
            'users.lastname as interviewer_lastname',
            'lead_statuses.leadstatusname as lead_status'
        )
        ->leftJoin('users', 'internal_leads.interviewee_id', '=', 'users.user_id')
        ->leftJoin('lead_statuses', 'internal_leads.status', '=', 'lead_statuses.leadstatusid')
        ->leftJoin('technologies', 'internal_leads.technology_id', '=', 'technologies.technology_id')
        ->where(function($queryBuilder) use ($query) {
            $queryBuilder->where(DB::raw("CONCAT(users.firstname, ' ', users.lastname)"), 'like', "%{$query}%")
            ->orWhere(DB::raw("CONCAT(technologies.technology_name, ')')"), 'like', "%{$query}%")
            ->orWhere(DB::raw("CONCAT(lead_statuses.leadstatusname, ')')"), 'like', "%{$query}%")
            ->orWhere(DB::raw("CONCAT(internal_leads.candidate_name, ')')"), 'like', "%{$query}%")
            ->orWhere(DB::raw("CONCAT(internal_leads.candidate_mobile, ')')"), 'like', "%{$query}%");
        })
        ->get();

       

        if ($leads->isEmpty()) {
            return response()->json(['message' => 'No records found']);
        }

        return response()->json($leads);
    }
}
