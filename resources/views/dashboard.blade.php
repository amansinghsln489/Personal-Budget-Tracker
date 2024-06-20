@extends('layouts.app')

@section('content')
@section('title', 'Dashboard')

<div class="page-wrapper">
	<div class="content container-fluid">

		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
					<h3 class="page-title mb-0">Dashboard</h3>
				</div>
				<div class="col-md-6">
					<ul class="breadcrumb mb-0 p-0 float-right">
						<li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item"><span>Dashboard</span></li>
					
					</ul>
					<!-- <p><i aria-hidden="true" class="fas fa-calendar-alt"></i> December 6, 2018</p>   -->
				</div>
			</div>
		</div>
		
		<!--
		|--------------------------------------------------------------------------
		| sales team Dashboard
		|--------------------------------------------------------------------------
		-->
			@if ($user->role == 2)
				@include('dashboard.salesTeamDashboard')
		
		<!--
		|--------------------------------------------------------------------------
		| Interviee Dashboard
		|--------------------------------------------------------------------------
		-->
			@elseif ($user->role == 3)
				@include('dashboard.IntervieeTeamDashboard')
			
		<!--
		|--------------------------------------------------------------------------
		| All Adminstrator Dashboard
		|--------------------------------------------------------------------------
		-->
			@else
				@include('dashboard.AdminstratorTeamDashboard')
			@endif
		<!--
		|--------------------------------------------------------------------------
		| Sales Team Today Lead 
		|--------------------------------------------------------------------------
		-->

@if ($user->role == 2 || $user->role == 1)
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h3 class="page-title mb-0">Candidate Technology</h3>
            </div>
        </div>
    </div>
    <div class="row">
        @php
        // Define an array of light background colors
        $backgroundColors = ['#ffe5e5', '#e5ffe5', '#e5e5ff', '#ffffcc', '#ccffff'];
        $colorIndex = 0;
        @endphp
        <div class="col-md-12">
            <table class="table table-bordered">
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
    </div>
    @include('section/notification') 
@endif
<!-- ============================================================================================================ -->

<!-- =================================================================================================================== -->


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

