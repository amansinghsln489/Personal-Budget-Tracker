<!--
    |--------------------------------------------------------------------------
    | All Adminstrator Dashboard
    |--------------------------------------------------------------------------
    -->
<div class="row">
        @php
        // Define an array of light background colors
        $backgroundColors = ['#ffe5e5', '#e5ffe5', '#e5e5ff', '#ffffcc', '#ccffff'];
        $colorIndex = 0;
        @endphp
        @foreach($users as $user)
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <a href="{{ route('condidate.list.show',['userId' => $user->user_id]) }}">
                    <div class="dash-widget dash-widget5" style="background-color: {{ $backgroundColors[$colorIndex % count($backgroundColors)] }};">
                        <div class="profile-img">
                            @if($user->user_image)
                                <span class="avatar">
                                    <img class="img-fluid" src="{{ asset('storage/' . $user->user_image) }}" alt="">
                                </span>
                            @else
                                <span class="avatar">{{ strtoupper(substr($user->firstname, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}</span>
                            @endif
                        </div>
                        
                        <div class="dash-widget-info text-right">
                            <strong><span>{{ $user->firstname }} {{ $user->lastname }}</span></strong>
                            <!-- You can use the countLeads() method to get the count -->
                            <h3>Today : {{ $user->todayLeadCount }}</h3>
                            <span>Total Candidate in this month : {{ $user->monthLeadCount }}</span>
                        </div>
                    </div>
                </a>
            </div>
            @php
                $colorIndex++;
            @endphp
        @endforeach
    </div>
   
   
   <div class="row">
       @php
       // Define an array of light background colors
       $backgroundColors = ['#ffe5e5', '#e5ffe5', '#e5e5ff', '#ffffcc', '#ccffff'];
       $colorIndex = 0;
       @endphp

       <div class="col-md-6">
           <div class="page-header">
               <div class="row">
                   <div class="col-md-6">
                       <h3 class="page-title mb-0">Candidate Technology</h3>
                   </div>
               </div>
           </div>
           <table class="table table-bordered" >
               <thead>
                   <tr>
                       <th>Technology</th>
                       <th>Total Interviews</th>
                       <th>Total Candidates Selected</th>
                       <th>Total Candidates Rejected</th>
                       <th>Action</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach($totalInterviews as $totalInterview)

                        
                       <tr style="background-color: {{ $backgroundColors[$colorIndex % count($backgroundColors)] }};">
                           <td>
                               {{ $totalInterview->technology->technology_name }}
                           </td>
                           <td>{{ $totalInterview->total }}</td>
                           <td>{{ $totalInterview->selected_total }}</td>
                           <td>{{ $totalInterview->unselected_total }}</td>
                           <td>
                               <a href="{{ route('condidate.list.all', ['candidatelist' => $totalInterview->technology_id]) }}">View More Details</a>
                           </td>
                       </tr>
                       @php
                           $colorIndex++;
                       @endphp
                   @endforeach
               </tbody>
           </table>
       </div>

       <div class="col-md-6">
           <div class="page-header">
               <div class="row">
                   <div class="col-md-6">
                       <h3 class="page-title mb-0">Interviewee</h3>
                   </div>
               </div>
           </div>
           <table class="table table-bordered" >
               <thead>
                   <tr>
                      <th>profile</th>
                       <th>Name</th>
                       <th>Total Interviews</th>
                       <th>Scheduled for today</th>
                       <th>Total interviews this month</th>
                       <th>Action</th>
                   </tr>
               </thead>
               <tbody>
               @foreach($interviewees as $interviewee)
                       <tr style="background-color: {{ $backgroundColors[$colorIndex % count($backgroundColors)] }};">
                       <td>
                           <img src="{{ asset('storage/' . $interviewee->user_image) }}" alt="Image of {{ $interviewee->firstname }} {{ $interviewee->lastname }}" width="50" height="50">
                       </td>
                       <td>
                           {{ $interviewee->firstname }} {{ $interviewee->lastname }}
                       </td>
                           <td>{{ $interviewee->total_interviews }}</td>
                           <td>{{ $interviewee->today_interviews }}</td>
                           <td>{{ $interviewee->monthLeadCount }}</td>
                           <td>
                               <a href="{{ route('condidate.list.show', ['userId' => $interviewee->user_id]) }}">View More Details</a>
                           </td>
                       </tr>
                       @php
                           $colorIndex++;
                       @endphp
                   @endforeach
               </tbody>
           </table>
       </div>

   </div>
   @include('section/notification') 
   