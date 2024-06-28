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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Hr\InternalLead;
use App\Models\Hr\InternalLeadDetail;
class IntervieweeController extends Controller
{  
    
    public function show(Request $request,$userId)
    {
        $today = Carbon::today()->toDateString(); 
        // Find the user by ID Sales Team
        $userLeadcreators = User::findOrFail($userId);
      
        $leadStatuss = LeadStatus::all();
        /*
        |--------------------------------------------------------------------------
        |  This is applied for the Interview they not see other user data form the url 
        |--------------------------------------------------------------------------
        */
        $current_user = Auth::user();
        if($current_user->role == 3 || $current_user->role == 2){
         
            // $userId = $current_user->user_id;
         
            // $userLeadcreators = User::findOrFail($userId);

           
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $interviewStatus = $request->input('status');
        if ($userLeadcreators->role == 3 || $userLeadcreators->role == 2) {  
            
            $query = InternalLead::with([ 'leadStatus','intervieweeName','userName','technology']);
            if($userId){
                $query->where(function($q) use ($userId) {
                    $q->where('created_by', $userId)
                      ->orWhere('interviewee_id', $userId);
                     
                });
            }
            if (!empty($interviewStatus)){
                $query->where('status', $interviewStatus);
    
                if (!empty($start_date) && !empty($end_date)) {
                    $query->whereBetween('created_at', [$start_date, $end_date]);
                }   
            }
            $leads= $query->get();

          
            $selectedValues = [
                'interview_status' => $interviewStatus,
            ];   
        } 
        return view('interviewee.interview_index', compact('userLeadcreators','leads','leadStatuss','selectedValues'));
        }
        /*
        |--------------------------------------------------------------------------
        |  For Sales Team
        |--------------------------------------------------------------------------
        */
        $current_user = Auth::user();
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $interviewStatus = $request->input('status');
        if($current_user->role == 2){
            $query = InternalLead::with([ 'leadStatus','intervieweeName','userName']);
            if($userId){
                $query ->where('created_by', $userId);
             }
             if (!empty($interviewStatus)){
                $query->where('status', $interviewStatus);
    
                if (!empty($start_date) && !empty($end_date)) {
                    $query->whereBetween('created_at', [$start_date, $end_date]);
                }    
            }
            $leads= $query->get();
            $selectedValues = [
                'interview_status' => $interviewStatus,
            ];
            return view('interviewee.interview_index', compact('userLeadcreators','leads','leadStatuss','selectedValues'));
        }
        $current_user = Auth::user();
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $interviewStatus = $request->input('status');
        if($current_user->role == 1)
        {
            $query = InternalLead::with([ 'leadStatus','intervieweeName','userName']);
            if ($userId) {
                $query->where(function($q) use ($userId) {
                    $q->where('created_by', $userId)
                      ->orWhere('interviewee_id', $userId);
                     
                });
            }
            if (!empty($interviewStatus)){
                $query->where('status', $interviewStatus);
                if (!empty($start_date) && !empty($end_date)) {
                    $query->whereBetween('created_at', [$start_date, $end_date]);
                }  
            }
            $leads= $query->get();
            $selectedValues = [
                'interview_status' => $interviewStatus,
            ];
            return view('interviewee.interview_index', compact('userLeadcreators','leads','leadStatuss','selectedValues'));
        }
    }
    public function candidateList(Request $request,$candidatelist)
    {
        $current_user = Auth::user();
        $userId = $current_user->user_id;
        $userLeadcreators = User::findOrFail($userId);
        $leadStatuss = LeadStatus::all();
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $interviewStatus = $request->input('status');
        $query = InternalLead::with([ 'leadStatus','intervieweeName','userName']);
        if($candidatelist){
            $query ->where('technology_id', $candidatelist);
         }
            
            if (!empty($interviewStatus)){
                $query->where('status', $interviewStatus);
    
                if (!empty($start_date) && !empty($end_date)){
                    $query->whereBetween('created_at', [$start_date, $end_date]);
                }   
            }
            $leads= $query->get();
            $selectedValues = [
                'interview_status' => $interviewStatus,
            ];
          
           
        return view('interviewee.technology_candidate_list', compact('userLeadcreators','leads','leadStatuss','selectedValues','candidatelist'));
    }
    public function view( $candidatelist)
    {
        $leadHistories = InternalLeadDetail::where('lead_id',$candidatelist)
        ->orderBy('created_at', 'ASC')
        ->with(['InternalLead','leadStatus', 'userName'])
        // Load the user relationship
        ->get();
        $leadDatas = InternalLead::with(['leadStatus', 'intervieweeName', 'userName','technology','experienceYear'])
        ->where('id','=', $candidatelist)
        ->get();  
        return view('interviewee.candidate_view',compact('leadDatas','leadHistories'));
    } 
    public function checkBox(Request $request)
    {
        $checkboxs_id = $request->input('checkboxIDs');
        $success = false;
        $status_update = false;
        $interview_status = $request->input('status');
        foreach ($checkboxs_id as $checkbox_id) {
            $interview_status = $request->input('status');
            
            $lead = InternalLead::find($checkbox_id);
            if ($lead->checkbox_status != 1){
                $lead->update(['checkbox_status' => 1]);
                $lead->update(['status' => $interview_status]);
                $success = true;
                $status_update = $lead->checkbox_status;
            }elseif ($lead->checkbox_status == 1) {
                $lead->update(['checkbox_status' => 1]);
                $lead->update(['status' => $interview_status]);
                $success = true;
            }
             else {
                $lead->update(['checkbox_status' => 0]);
                $success = false;
                $status_update = $lead->checkbox_status;
            }
        }
        return response()->json([
            'success' => $success, 
            'status' => $status_update,
            'interview_status' => $interview_status 
        ]);
            
            
           
                
    } 
}
