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
                <a href="">
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
                            <span>Total Lead in this month : {{ $user->monthLeadCount }}</span>
                        </div>
                    </div>
                </a>
            </div>
            @php
                $colorIndex++;
            @endphp
        @endforeach
    </div>
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h3 class="page-title mb-0">Interviewee</h3>
            </div>
        
        </div>
    </div>
<div class="row">
    @php
        // Define an array of light background colors
        $backgroundColors = ['#f0f0f0', '#fafafa', '#f5f5f5', '#fcfcfc', '#f9f9f9'];
        $colorIndex = 0;
    @endphp
    @foreach($interviewees as $interviewee)
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <a href="{{ route('condidate.list.show', ['userId' => $interviewee->user_id]) }}">
            <div class="dash-widget dash-widget5" style="background-color: {{ $backgroundColors[$colorIndex % count($backgroundColors)] }}; {{ $interviewee->today_interviews > 0 ? 'border: 3px solid green; font-weight: bold;' : '' }}">                    <div class="profile-img">
                        @if($interviewee->user_image)
                            <span class="avatar">
                                <img class="img-fluid" src="{{ asset('storage/' . $interviewee->user_image) }}" alt="">
                            </span>
                        @else
                            <span class="avatar">{{ strtoupper(substr($interviewee->firstname, 0, 1)) }}{{ strtoupper(substr($interviewee->lastname, 0, 1)) }}</span>
                        @endif
                    </div>
                    <div class="dash-widget-info text-right">
                    <h3>{{ $interviewee->firstname }} {{ $interviewee->lastname }}</h3>
                        <h4>Total interviews taken: {{ $interviewee->total_interviews }}</h4>
                        <h4>Scheduled for today: {{ $interviewee->today_interviews }}</h4>
                        <h4>Total interviews in month: {{ $interviewee->monthLeadCount }}</h4>
                    </div>
                </div>
            </a>
        </div>
        @php
            $colorIndex++;
        @endphp
    @endforeach

</div>