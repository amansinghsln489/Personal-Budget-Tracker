@extends('layouts.app')

@section('content')
@section('title', 'Dashboard')

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <h5 class="text-uppercase mb-0 mt-0 page-title">Candidate Details</h5>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <ul class="breadcrumb float-right p-0 mb-0">
                            <li class="breadcrumb-item"><a href="indeX-2.html"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item"><span> Profile</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-box m-b-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="#"><img class="avatar" src="{{ asset('storage/' . $interview->image) }}" alt=""></a>
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                   
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                        <li>
                                                <span class="title">Candidate Name</span>
                                                <span class="text"> {{$interview->candidate_name}}</span>
                                            </li>
                                            <li>
                                                <span class="title">Phone:</span>
                                                <span class="text"><a href="tel:{{ $interview->candidate_mobile }}"> {{$interview->candidate_mobile}}</a></span>
                                            </li>
                                            <li>
                                                <span class="title">Email:</span>
                                                <span class="text"><a href="mailto:{{ $interview->candidate_email }}">{{$interview->candidate_email}}</a></span>
                                            </li>
                                            <li>
                                                <span class="title">Interview Date:</span>
                                                <span class="text">{{$interview->interview_date}}</span>
                                            </li>
                                            <li>
                                                <span class="title">Interview Status:</span>
                                                <span class="text">{{$interview->leadStatus->leadstatusname}}</span>
                                            </li>
                                            <li>
                                                <span class="title">Candidate Interview feedback:</span>
                                                <span class="text">{{$interview->additional_comments}}</span>
                                            </li>
                                            <li>
                                                <span class="title">Additional Comments:</span>
                                                <span class="text">{{$interview->candidate_interview_feedback}}</span>
                                            </li>
                                            <li>
                                                <span class="title"><h4>Interviewer's name:</h4></span>
                                                <span class="text"><h3>{{$interview->intervieweeName->name}}</h3></span>
                                            </li>

                                            <!-- You can add more fields here as needed -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('section/notification') 
    </div>


<script>
	$(function () {
		$("#example1").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false,
			"buttons": ["pdf"]
			// "order": [[0, "desc"]] 
		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

