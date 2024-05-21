@extends('layouts.app')

@section('content')
@section('title', 'Lead')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title"> Lead Lists of  {{ $userLeadcreators->firstname }} {{ $userLeadcreators->lastname }}
                  
                    </h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="add-card.php">Lead</a></li>
                        <li class="breadcrumb-item"><span> Add Lead</span></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!-- Display Toastr messages -->
        <script>
            $(document).ready(function() {
                @if(session('error'))
                    toastr.error("{{ session('error') }}", "", { 
                        timeOut: 5000, 
                        progressBar: true,
                        positionClass: "toast-top-center"
                    });
                @endif

                @if(session('success'))
                    toastr.success("{{ session('success') }}", "", { 
                        timeOut: 5000, 
                        progressBar: true,
                        positionClass: "toast-top-center"
                    });
                @endif
            });
        </script>
        <div class="content-page">

            <div class="row">
                <div class="col-sm-5 col-4">
                    <!-- Content for the first column -->
                </div>
                <div class="col-sm-7 col-8 text-right add-btn-col">
                    @auth
                        @if(auth()->user()->role != 3)
                            <a href="{{ route('add.lead') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> Add New Lead </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- <form class="m-b-30" method="POST" action="{{ route('user.leadsearchhow', ['searchuserId' => $userLeadcreators->user_id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input class="form-control datetimepicker-input floating datetimepicker" type="text" name="from_date" data-toggle="datetimepicker" value="{{ isset($selectedValues['from_date']) ? $selectedValues['from_date'] : '' }}">
                            <label class="focus-label">From</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input class="form-control datetimepicker-input datetimepicker floating" type="text" name="to_date" data-toggle="datetimepicker" value="{{ isset($selectedValues['to_date']) ? $selectedValues['to_date'] : '' }}">
                            <label class="focus-label">To</label>
                        </div>
                    </div>
                
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                        <select class="form-control select2" name="interview_status">
                            <option value="">--Select--</option>
                            @foreach($LeadStatuss as $LeadStatus)
                                <option value="{{ $LeadStatus->leadstatusid }}" {{ isset($selectedValues['interview_status']) && $selectedValues['interview_status'] == $LeadStatus->leadstatusid ? 'selected' : '' }}>{{ $LeadStatus->leadstatusname }}</option>
                            @endforeach
                        </select>
                            <label class="focus-label">Interview Status</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="submit" class="btn btn-search rounded btn-block mb-3">Search</button>
                    </div>
                </div>
            </form> -->

            <div class="row">
                <div class="col-lg-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="page-title">
                                        Lead Lists
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Company</th>
                                            <th style="display: none;">email</th>
                                            <th>Technologies</th>
                                            <th>Vendor</th>
                                            <th>Interviewee</th>
                                            <th>Interview Date</th>
                                            <th>Lead Comment</th>
                                            <th>Interview Status</th>
                                            <th>Created BY</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($leads as $lead)
                                            <tr>
                                                <!-- <td>{{ $lead->id }}</td> -->
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <i class="fa fa-building"></i> 
                                                    <span style="color: blue; font-weight: bold;">
                                                        {{ mb_strimwidth($lead->company->company_name, 0, 18, '...') }}
                                                    </span>
                                                    <h2><a href="{{ route('leads.show', $lead->id) }}"> </a></h2>
                                                    <span> {{ $lead->company_phone }} </span>
                                                    @if(isset($lead->company_rate))
                                                        <div class="badge badge-success">
                                                            <span class="text">{{ $lead->company_rate }}</span>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td style="display: none;">
                                                    {{ $lead->company_email }}
                                                </td>
                                                <td>
                                                    <i></i> {{ $lead->vendor->technology->technology_name }}
                                                </td>
                                                <td>
                                                    <i class="fa fa-user"></i> {{ $lead->vendor->name }}  <h2><a href="{{ route('leads.show', $lead->id) }}">{{ $lead->vendor->technology->technology_name }}</a></h2>
                                                </td>
                                                <td>
                                                    <i class="fa fa-id-card"></i> {{ $lead->interviewer->firstname }} {{ $lead->interviewer->lastname }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($lead->interview_date)->format('d-m-Y') }}</td>

                                                <td>
                                                    <textarea name="lead_comment" class="form-control" rows="2" readonly data-toggle="popover" title="Lead Comments" data-content="{{ $lead->lead_comment }}">{{ $lead->lead_comment }}</textarea>
                                                </td>

                                                <td style="font-weight: bold; white-space: nowrap; overflow: hidden; text-overflow:     ellipsis; max-width: 100px;">
                                                        {{ $lead->leadStatus->leadstatusname }}
                                                </td>
                                                <td>
                                                    {{ $lead->createdUser->firstname }}
                                                </td>

                                                <td>
                                                    {{ \Carbon\Carbon::parse($lead->created_at)->format('d M Y') }}
                                                </td>
                                                <td class="text-right">
                                                @if(auth()->user()->role != 3)
                                                    <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                @endif
                                                    <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-warning btn-sm mb-1">
                                                        <i class="far fa-eye"></i>
                                                    </a>

                                                    <!-- <a class="btn btn-danger btn-sm mb-1" href="{{ route('leads.destroy', $lead->id) }}" onclick="event.preventDefault(); document.getElementById('delete-lead-form-{{ $lead->id }}').submit();">
                                                    <i class="far fa-trash-alt"></i>
                                                    </a>

                                                    <form id="delete-lead-form-{{ $lead->id }}" action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form> -->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('section/notification') 
    </div>
    <div id="delete_employee" class="modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Role</h4>
                </div>
                <form>
                    <div class="modal-body">
                        <p>Are you sure want to delete this?</p>
                        <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
		$(function () {
			$("#example1").DataTable({
				"responsive": true,
				"lengthChange": false,
				"autoWidth": false,
				"buttons": ["pdf", "print", "excel"],
				"order": [[0, "desc"]],
				"pageLength": 10 
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		});
</script>
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#imagePreview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>

<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<script src="{{ asset('assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>

@endsection

   

