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
					<!--<p><i aria-hidden="true" class="fas fa-calendar-alt"></i> December 6, 2018</p>-->
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
	    <div class="page-header">
          <div class="row">
				<div class="col-md-6">
					<h3 class="page-title mb-0">Total Interview</h3>
				</div>
          </div>
       </div>
	<div class="row">
        @php
        // Define an array of light background colors
        $backgroundColors = ['#ffe5e5', '#e5ffe5', '#e5e5ff', '#ffffcc', '#ccffff'];
        $colorIndex = 0;
        @endphp
        @foreach($totalInterviews as $totalInterview)
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <a href="">
                    <div class="dash-widget dash-widget5" style="background-color: {{ $backgroundColors[$colorIndex % count($backgroundColors)] }};">
                        
						<div class="dash-widget-info text-right">
                        <strong><span>Total Interview in {{ $totalInterview->technology->technology_name }}  : {{ $totalInterview->total }}</span></strong>
                        <h5>Total Condidate Selected in {{ $totalInterview->technology->technology_name }}    : {{ $totalInterview->selected_total }} </h5>
                        <span>Total Condidate Rejected in  {{ $totalInterview->technology->technology_name }}  : {{ $totalInterview->unselected_total }} </span>
                    </div>
                    </div>
                </a>
            </div>
            @php
                $colorIndex++;
            @endphp
        @endforeach	
    </div>
	
		@include('section/notification') 
	</div>

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

