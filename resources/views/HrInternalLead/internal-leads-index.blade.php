@extends('layouts.app')
@section('content')
@section('title', 'Candidate')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">All Candidate List</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('internal-leads.index') }}">Candidates</a></li>
                        <li class="breadcrumb-item"><span> Add Candidate</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-12 text-left add-btn-col">
                <a href="{{ route('internal-leads.create') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> Add New Candidate </a>
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

                @foreach ($candidates->groupBy('status') as $statusId => $groupedLeads)
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
                        <p class="card-text">{{ $candidates->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="filter-form"class="m-b-30" method="POST" action="{{ route('internal-leads.index') }}" enctype="multipart/form-data">
         @csrf
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <div class="input-group">
                            <input class="form-control " type="date" data-toggle="datetimepicker" name="start_date" value="{{ request()->get('start_date', '') }}">
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
                        <select class="form-control" name="status"  >
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
        </form>
        <!-- ======================================================================= -->
       <div id="dropdown-container" style="display: none;">
            <div class="col-md-4">
                <div class="form-group">
                    <strong><label> Candidate Status </label></strong>
                    <select id="candidate-status" class="form-control select2" name="candidate-status" style="width: 80%; height: 30px; font-size: 10px;">
                        <option value="" disabled selected>Candidate Status Change</option>
                        @foreach($leadStatuss as $status)
                            <option value="{{ $status->leadstatusid }}">
                                {{ $status->leadstatusname }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div> 
        </div>
        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!-- Display Toastr messages -->
     
        <script>
            
          $(document).ready(function() {
                $('#reset-button').click(function() {
                    $('input[name="start_date"]').val('');
                    $('input[name="end_date"]').val('');
                    $('select').prop('selectedIndex', 0);
                
                });
            });
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                <th><input type="checkbox" id="select-all"></th>                                  
                                    <th> Name</th>
                                    <th>Email</th>
                                    <th>Interview Date</th>
                                    <th>Status</th>
                                    <th>Resume</th>
                                    <th>Interviewer</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($candidates as $candidate)
                                <tr id="target-row{{ $candidate->id }}" style="color: {{ $candidate->leadStatus->leadstatusname === 'Rejected' ? 'red' : ($candidate->leadStatus->leadstatusname === 'Closed' ? 'green' : 'black') }}">
                                <td>
                                <input type="checkbox" class="read-checkbox" data-leadid="{{ $candidate->id }}" ></td>
                                
                                    <td>{{ $candidate->candidate_name }}</td>
                                    <td>{{ $candidate->candidate_email }}<br>
                                    {{ $candidate->candidate_mobile }}
                                    </td>
                                    <td class="highlight">{{ \Carbon\Carbon::parse($candidate->interview_date)->format('d-M-Y h:i A')}}</td>

                                   
                                    <td >
                                        {{ $candidate->leadStatus->leadstatusname }}
                                    </td>

                                    <td data-label="@lang('Resume')">
                                    @if($candidate->resume)
                                    @php
                                        $extension = pathinfo($candidate->resume, PATHINFO_EXTENSION);
                                    @endphp

                                    @if (in_array($extension, ['pdf']))
                                    <a href="{{ asset('storage/' . $candidate->resume) }}" target="_blank">
                                        <img src="{{ asset('assets/img/pdf.png') }}" alt="Pdf" style="height:30px;"/>
                                        View
                                        <i class="fas fa-download"></i>
                                    </a>
                                    @elseif(in_array($extension, ['docx']))  
                                    <a href="{{ asset('storage/' . $candidate->resume) }}" target="_blank">
                                        <img src="{{ asset('assets/img/docx.png') }}" alt="docx" style="height:30px;"/>
                                        Download
                                        <i class="fas fa-download"></i>
                                    </a>
                                    @elseif(in_array($extension, ['doc']))  
                                    <a href="{{ asset('storage/' . $candidate->resume) }}" target="_blank">
                                        <img src="{{ asset('assets/img/docx.png') }}" alt="docx" style="height:30px;"/>
                                        Download
                                        <i class="fas fa-download"></i>
                                    </a>
                                    @endif
                                        @else
                                        empty
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($candidate->intervieweeName->firstname))
                                            <span title="{{ $candidate->intervieweeName->firstname }} {{ $candidate->intervieweeName->lastname }}">
                                                {{ $candidate->intervieweeName->firstname }}
                                            </span>
                                        @endif
                                    </td>
                                    <td><span title="{{ $candidate->userName->firstname }} {{ $candidate->userName->lastname }}">
                                                {{ $candidate->userName->firstname }}
                                            </span><br>  
                                        {{ \Carbon\Carbon::parse($candidate->created_at)->format('d-m-Y') }}
                                    </td>
                                    
                                    <td class="text-right">
                                        <a href="{{ route('internal-leads.edit', $candidate->id) }}" class="btn btn-primary btn-sm mb-1">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        

                                            <a href="{{ route('internal-leads.show', $candidate->id) }}" class="btn btn-warning btn-sm mb-1">
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
        @include('section/notification') 
    </div>

    <!-- <div id="delete_employee" class="modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Candidate</h4>
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
</div> -->
<script>
         $(document).ready(function() {
            var table =  $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "bStateSave": true,
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
        $(document).ready(function() {
            $('.select2').select2();
        });
       
// =================================================================================
 // interview status chancge here

 $(document).ready(function(){
   
        $(function(){
            $("#candidate-status").change(function() {
            var interview_status =$(this).val();
            sendCheckboxIDs(checkboxIDs,interview_status);
                console.log(checkboxIDs);
                console.log(interview_status);
            });
            
        });

        var checkboxIDs = []; 
        const dropdown = $('#dropdown-container');
    // Handle select-all checkbox change event
    $('#select-all').change(function() {
        const isChecked = this.checked;
        $('.read-checkbox').prop('checked', isChecked).each(function() {
            const leadId = $(this).data('leadid');
           
           var checkbox = isChecked ? checkboxIDs.push(leadId) : checkboxIDs = checkboxIDs.filter(id => id !== leadId);
         
            const dropdown = document.getElementById('dropdown-container'); 
            if(isChecked)
            {
                dropdown.style.display = 'block';
            }
            else{
                dropdown.style.display = 'none';
            }
            
            // sendCheckboxIDs(checkbox);
        }); 
    });
    // Handle individual checkbox change event
    $(document).on('change', '.read-checkbox', function() {
        const leadId = $(this).data('leadid');
       var checkbox = this.checked ? checkboxIDs.push(leadId) : checkboxIDs = checkboxIDs.filter(id => id !== leadId);
      
       const dropdown = document.getElementById('dropdown-container'); 
       var checkbox = $(this);
       var isChecked = checkbox.prop('checked');
       if(isChecked)
            {
                dropdown.style.display = 'block';
            }  
            // sendCheckboxIDs(checkbox);
    });
    // Function to send the checkboxIDs array via AJAX
    function sendCheckboxIDs(checkboxIDs,status) {
            
        $.ajax({
            url: '{{ route("candidate.checkbox") }}',
            type: 'POST',
            data: { 
                checkboxIDs: checkboxIDs,
                status: status,
                _token: '{{ csrf_token() }}'
            },
            success: function(response){
                var row = $('#target-row' +checkboxIDs);
                row.removeClass('highlight-red highlight-green highlight-black');
                if (response.interview_status ){
                   
                    window.location.href = "/internal-leads";

                } 
            },
            error: function(xhr) {
                // Handle error response if needed
            }
        });
    }
});
</script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>
@endsection
