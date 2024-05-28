<!--
    |--------------------------------------------------------------------------
    | Interviee Dashboard
    |--------------------------------------------------------------------------
    -->
   <!-- FullCalendar CSS -->

<div class="row">
@php
    $backgroundColors = ['#f0f0f0', '#fafafa', '#f5f5f5', '#fcfcfc', '#f9f9f9'];
    $colorIndex = 0;
@endphp
@foreach($interviewees as $interviewee)
    @if($interviewee->user_id == $user->user_id)
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <a href="{{ route('condidate.list.show', ['userId' => $interviewee->user_id]) }}">
                <div class="dash-widget dash-widget5" style="background-color: {{ $backgroundColors[$colorIndex % count($backgroundColors)] }}; {{ $interviewee->today_interviews > 0 ? 'border: 3px solid green; font-weight: bold;' : '' }}">
                    <div class="profile-img">
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
                        <h4>Total interviews this month: {{ $interviewee->monthLeadCount }}</h4>
                    </div>
                </div>
            </a>
        </div>
        
     
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/dist/fullcalendar.min.js"></script>
   <div id= "clandar"></div>

   <script>
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta [name=csrf-token]').attr('content');
        }
        });
        var calendarEl = document.getElementById('clandar');
            var events = [];
            var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
            left: 'prev, next today',
            center: 'title',
            right: 'dayGrid Month, timeGridWeek, timeGridDay'
            },
            initialView: 'dayGridMonth',
            timeZone: 'UTC',
            events: /events
            editable: true,
            });
            calendar.render();
</script>
    

   

    @endif
    @php
        $colorIndex++;
    @endphp
@endforeach
</div>



