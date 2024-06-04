@extends('layouts.app')
@section('content')
@section('title', 'Lead')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title"> Candidate Lists of  {{ $userLeadcreators->firstname }} {{ $userLeadcreators->lastname }}
                  
                    </h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="add-card.php">Candidate</a></li>
                        <li class="breadcrumb-item"><span> Add Candidate</span></li>
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
                           
                        @endif
                    @endauth
                </div>
            </div>

            <form class="m-b-30" method="POST" action="{{ route('candidate-search',$userLeadcreators->user_id ) }}" enctype="multipart/form-data">
            @csrf
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <div class="input-group">
                            <input class="form-control " type="date" data-toggle="datetimepicker" name="start_date" required>
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
                            <input class="form-control" type="date" data-toggle="datetimepicker" name="end_date" required>
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
                        <select class="form-control" name="status"  required>
                        <option value="">--Select--</option>
                            @foreach($leadStatuss as $LeadStatus)
                                <option value="{{ $LeadStatus->leadstatusid }}">{{ $LeadStatus->leadstatusname }}</option>
                            @endforeach
                        </select>
                        <label class="focus-label">Status</label>
                    </div>
                </div>
            <div class="col-sm-6 col-md-3">
           <button class="btn btn-search rounded btn-block mb-3">Search</button>
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
                                        <th>Id</th>                                      
                                        <th>Candidate Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Interview Date</th>
                                        <th>Status</th>
                                        <th>Resume</th>
                                        <th>Interviewee Name</th>
                                        <th>Created_by</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>



                                        @foreach($leads as $lead)
                                        <tr>
                                        <td>{{ $lead->id }}</td>
                                        <td>{{ $lead->candidate_name }}</td>
                                        <td>{{ $lead->candidate_email }}</td>
                                        <td>{{ $lead->candidate_mobile }}</td>
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
                                           Not upload resume
                                           @endif
                                        </td>
                                        <td>
                                        @if(!empty( $lead->intervieweeName->firstname))
                                        {{ $lead->intervieweeName->firstname }} {{ $lead->intervieweeName->lastname}}
                                        @endif
                                        </td>
                                        <td>{{ $lead->userName->firstname}} {{ $lead->userName->lastname}}</td>  
                                        <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('d-m-Y') }}</td>
                                        <td class="text-right">
                                            <!-- <a href="{{ route('internal-leads.edit', $lead->id) }}" class="btn btn-primary btn-sm mb-1">
                                                <i class="far fa-edit"></i>
                                            </a> -->
                                            <!-- <a href="{{ route('internal-leads.show', $lead->id) }}" class="btn btn-primary btn-sm mb-1">
                                            <i class="far fa-eye"></i>
                                            </a> -->

                                                <a href="{{ route('internal-leads.show', $lead->id) }}" class="btn btn-warning btn-sm mb-1">
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
                            columns:  [1, 2, 3, 4, 5, 7, 8, 9]
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<img src="{{ asset('assets/img/excel.png') }}" alt="Excel" style="height:20px;"/> Excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 7, 8, 9]
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<img src="{{ asset('assets/img/pdf.png') }}" alt="Pdf" style="height:20px;"/> Pdf',
                        exportOptions: {
                            columns:  [1, 2, 3, 4, 5, 7, 8, 9] 
                        }
                    },
                    'colvis'
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
</script>

<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<script src="{{ asset('assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>

@endsection

   

