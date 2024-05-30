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
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="page-title">Interview Detail</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           @if($data)
                                @foreach ($data as $index => $timerData)
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item list-group-item-info"> 
                                        <h5 id="targetTime{{ $index }}"></h5>  
                                        </li>
                                        <li class="list-group-item">
                                            <p id="countdown{{ $index }}"></p>
                                            <p id="totalTime{{ $index }}"></p>
                                        </li>
                                    </ul>
                                    @endforeach
                                @else
                                <li class="list-group-item">
                                    <p >Today is not any interview</p>
                                   
                                </li>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
      <script>
            document.addEventListener('DOMContentLoaded', function() {
            const data = <?php echo json_encode($data); ?>;

            data.forEach((timerData, index) => {
                let timeDifferenceInSeconds = timerData.timeDifferenceInSeconds;

                function updateCountdown() {
                    if (timeDifferenceInSeconds > 0) {
                        timeDifferenceInSeconds--;

                        let hours = Math.floor(timeDifferenceInSeconds / 3600);
                        let minutes = Math.floor((timeDifferenceInSeconds % 3600) / 60);
                        let seconds = timeDifferenceInSeconds % 60;

                        document.getElementById(`countdown${index}`).innerText =
                            `Left Time: ${hours} hours, ${minutes} minutes, ${seconds} seconds`;
                    } else {
                        document.getElementById(`countdown${index}`).innerText = 'Time is up!';
                        clearInterval(countdownIntervals[index]); // Stop the countdown when time is up
                    }
                }

                // Initial display
                document.getElementById(`targetTime${index}`).innerText = `Candidate Name: ${timerData.candidateName}`;
                document.getElementById(`totalTime${index}`).innerText = `Interview Time: ${timerData.interviewDate}`;
                updateCountdown();

                // Update the countdown every second
                const countdownInterval = setInterval(updateCountdown, 1000);
                countdownIntervals.push(countdownInterval); // Store the interval for each timer
            });
        });
        const countdownIntervals = []; // To store intervals for each countdown
    </script> 
    @endif
    @php
        $colorIndex++;
    @endphp
@endforeach
</div>



