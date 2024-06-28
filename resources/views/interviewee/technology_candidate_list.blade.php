@extends('layouts.app')
@section('content')
@section('title', 'Lead')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    @if($leads->isNotEmpty())
                        <h5 class="text-uppercase mb-0 mt-0 page-title">Candidate Lists {{ $leads->first()->technology->technology_name }} Technology</h5>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="">Candidate</a></li>
                        <li class="breadcrumb-item"><span> Add Candidate</span></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div id="custom-page-header">
       <div class="row mt-4">
        <div class="col-12">
            <div class="lead-status-cards">
                @php
                    $statusMapping = [
                        1 => ['badgeClass' => 'badge-secondary', 'iconClass' => 'fas fa-phone', 'cardClass' => 'bg-light-secondary'],
                        2 => ['badgeClass' => 'badge-primary', 'iconClass' => 'fas fa-search', 'cardClass' => 'bg-light-primary'],
                        3 => ['badgeClass' => 'badge-info', 'iconClass' => 'fas fa-cog', 'cardClass' => 'bg-light-info'],
                        4 => ['badgeClass' => 'badge-success', 'iconClass' => 'fas fa-file-alt', 'cardClass' => 'bg-light-success'],
                        5 => ['badgeClass' => 'badge-warning', 'iconClass' => 'fas fa-file-signature', 'cardClass' => 'bg-light-warning'],
                        6 => ['badgeClass' => 'badge-danger', 'iconClass' => 'fas fa-file-invoice', 'cardClass' => 'bg-light-danger'],
                        7 => ['badgeClass' => 'badge-danger', 'iconClass' => 'fas fa-times-circle', 'cardClass' => 'bg-light-danger'],
                        8 => ['badgeClass' => 'badge-dark', 'iconClass' => 'fas fa-users', 'cardClass' => 'bg-light-dark'],
                        9 => ['badgeClass' => 'badge-info', 'iconClass' => 'fas fa-check-circle', 'cardClass' => 'bg-light-success']
                    ];
                @endphp

                @foreach ($leads->groupBy('status') as $statusId => $groupedLeads)
                    @php
                        $badgeClass = $statusMapping[$statusId]['badgeClass'] ?? 'badge-secondary';
                        $iconClass = $statusMapping[$statusId]['iconClass'] ?? 'fas fa-info-circle';
                        $cardClass = $statusMapping[$statusId]['cardClass'] ?? 'bg-light-secondary';
                        $leadStatusName = $groupedLeads->first()->leadStatus->leadstatusname ?? 'Unknown';
                    @endphp

                    <div class="lead-status-card text-center {{ $cardClass }}">
                        <a target="_blank" href="" class="lead-status-card-link">
                            <div class="card-body">
                                <span class="badge {{ $badgeClass }} mb-2">
                                    <i class="{{ $iconClass }}"></i>
                                </span>
                                <h6 class="card-title">{{ $leadStatusName }}</h6>
                                <p class="card-text">{{ $groupedLeads->count() }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach

                {{-- Total Leads Card --}}
                <div class="lead-status-card text-center bg-light-primary">
                    <div class="card-body">
                        <span class="badge badge-primary mb-2">
                            <i class="fas fa-list"></i> {{-- FontAwesome icon --}}
                        </span>
                        <h6 class="card-title">Total Candidate</h6>
                        <p class="card-text">{{ $leads->count() }}</p>
                    </div>
                </div>
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
                           
                        @endif
                    @endauth
                </div>
            </div>

            <form id="filter-form" class="m-b-30" method="POST" action="{{ route('condidate.list.all',$candidatelist ) }}" enctype="multipart/form-data">
            @csrf
            <div class="row filter-row">
            
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <div class="input-group">

                        <!-- <input type="text" class="form-control datetimepicker-input datetimepicker floating" id="datetimepicker1"  data-toggle="datetimepicker" name="start_date"> -->
                        <input class="form-control" type="date" name="start_date" value="{{ request()->get('start_date', '') }}" id="start_date">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                        <label class="focus-label">From</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <div class="input-group">
                            <input class="form-control" type="date" data-toggle="datetimepicker" name="end_date" value="{{ request()->get('end_date', '') }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                        <label class="focus-label">To</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="form-control" name="status" >
                        <option value="">--Select--</option>
                            @foreach($leadStatuss as $leadStatus)
                            <option value="{{ $leadStatus->leadstatusid }}" {{ isset($selectedValues['interview_status']) && $selectedValues['interview_status'] == $leadStatus->leadstatusid ? 'selected' : '' }}>{{ $leadStatus->leadstatusname }}</option>
                            @endforeach
                        </select>
                        <label class="focus-label">Status</label>
                    </div>
                </div>
            <div class="col-sm-6 col-md-2">
               <button class="btn btn-search rounded btn-block mb-3">Search</button>
            </div>
            <div class="col-sm-6 col-md-1">
            <button  id="reset-button" class="btn btn-search rounded btn-block mb-3">Reset</button>
            </div>
            </div>
        <form>

            <div class="row">
                <div class="col-lg-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="page-title">
                                        Candidate Lists
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                            
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>                                
                                        <th> Name</th>
                                        <th>Email</th>
                                        <th>Interview Date</th>
                                        <th>Status</th>
                                        <th>Resume</th>
                                        <th>Interviewee</th>
                                        <th>Created </th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($leads as $lead)
                                        <tr style="color: {{ $lead->leadStatus->leadstatusname === 'Rejected' ? 'red' : ($lead->leadStatus->leadstatusname === 'Closed' ? 'green' : 'black') }}">
                                        <td>{{ $lead->candidate_name }}</td>
                                        <td>{{ $lead->candidate_email }}<br>
                                        {{ $lead->candidate_mobile }}
                                        </td>
                                        <td class="highlight">{{ \Carbon\Carbon::parse($lead->interview_date)->format('Y-m-d h:i:s A')}}</td>
                                        <td>{{ $lead->leadStatus->leadstatusname }}</td>
                                        <td data-label="@lang('Resume')">
                                        @if($lead->resume)

                                        @php
                                            $extension = pathinfo($lead->resume, PATHINFO_EXTENSION);
                                        @endphp

                                        @if (in_array($extension, ['pdf']))
                                        <a href="{{ asset('storage/' . $lead->resume) }}" target="_blank">
                                            <img src="{{ asset('assets/img/pdf.png') }}" alt="Pdf" style="height:30px;"/>
                                            Download
                                            <i class="fas fa-download"></i>
                                        </a>  
                                        @elseif(in_array($extension, ['docx']))  
                                        <a href="{{ asset('storage/' . $lead->resume) }}" target="_blank">
                                            <img src="{{ asset('assets/img/docx.png') }}" alt="docx" style="height:30px;"/>
                                            Download
                                            <i class="fas fa-download"></i>
                                        </a>
                                        @endif
                                                                              
                                          @else
                                         Empty
                                           @endif
                                        </td>
                                        <td>
                                        @if(!empty( $lead->intervieweeName->firstname))
                                        <span title="{{ $lead->intervieweeName->firstname }} {{ $lead->intervieweeName->lastname }}">
                                                    {{ $lead->intervieweeName->firstname }}
                                                </span>
                                        @endif
                                        </td>
                                        <td><span title="{{ $lead->userName->firstname }} {{ $lead->userName->lastname }}">
                                                    {{ $lead->userName->firstname }}
                                                </span><br>  
                                         {{ \Carbon\Carbon::parse($lead->created_at)->format('d-m-Y') }}
                                        </td>
                                        <td class="text-right">
                                                <a href="{{ route('condidate-leads.view', $lead->id) }}" class="btn btn-warning btn-sm mb-1">
                                                    <i class="far fa-eye"></i>
                                                </a>

                                            <!-- Add other action buttons as needed -->
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
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function() {
        $('.select2').select2();
    });
    $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns:  [1, 2, 3, 4, 6, 7, ]
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<img src="{{ asset('assets/img/excel.png') }}" alt="Excel" style="height:20px;"/> Excel',
                        exportOptions: {
                            columns:  [1, 2, 3, 4, 6, 7, ]
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<img src="{{ asset('assets/img/pdf.png') }}" alt="Pdf" style="height:20px;"/> Pdf',
                        exportOptions: {
                            columns:  [1, 2, 3, 4, 6, 7, ]
                        }
                    },
                    'colvis'
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
</script>

<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script>
     $(document).ready(function() {
                $('#reset-button').click(function() {
                    $('input[name="start_date"]').val('');
                    $('input[name="end_date"]').val('');
                    $('select').prop('selectedIndex', 0);
                
                });
            });
    </script>
@endsection

   

