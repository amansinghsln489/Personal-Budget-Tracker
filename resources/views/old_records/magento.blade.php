@extends('layouts.app')

@section('content')
@section('title', 'Magento Record')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">Old Magento Records</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Old Record</a></li>
                        <li class="breadcrumb-item"><span> Magento</span></li>
                    </ul>
                </div>
            </div>
            
            <!-- <div class="col-sm-12 col-12 text-left add-btn-col">
                 <a href="{{ route('vendors.createVendor') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> Add New Vendor </a>
            </div> -->
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
        <div class="row">
            <div class="col-lg-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="page-title">
                                    Magento Old DataBase
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Interview Date</th>
                                    <th>Client Name</th>
                                    <th>Candidate Name</th>
                                    <th>Client Email & Cell No</th>
                                    <th>Source</th>
                                    <th>Rate Part</th>
                                    <!-- <th>Pre Call Notes</th> -->
                                    <!-- <th>Meeting Link</th> -->
                                    <!-- <th>Post Call Notes</th> -->
                                    <!-- <th>Selected/Rejected Note</th> -->
                                    <th>Interview Taken By</th>
                                    <th>Technology</th>
                                    <!-- <th>Client Email ID</th>
                                    <th>Client Cell No</th> -->
                                    <!-- <th>Created At</th>
                                    <th>Updated At</th> -->
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($magentoOldRecords as $magentoOldRecord)
                                    <tr>
                                        <td>{{ $magentoOldRecord->id }}</td>
                                        <td>{{ $magentoOldRecord->interview_date }}</td>

                                        <td>
                                            @php
                                                $clientNameParts = explode(' ', $magentoOldRecord->client_name);
                                                $chunks = array_chunk($clientNameParts, 2);
                                            @endphp

                                            @foreach($chunks as $chunk)
                                                {{ implode(' ', $chunk) }}<br>
                                            @endforeach
                                        </td>                                      
                                        <td>{{ $magentoOldRecord->candidate_name }}</td>
                                       
                                        <td>
                                            @php
                                                $emailCell = $magentoOldRecord->client_email_cell;
                                                $words = explode(' ', $emailCell);
                                                $chunkedWords = array_chunk($words, 3); // Break after every 3 words
                                            @endphp

                                            @foreach($chunkedWords as $chunk)
                                                {{ implode(' ', $chunk) }}<br>
                                            @endforeach
                                        </td>
                                       

                                        <td>{{ $magentoOldRecord->interview_source }}</td>
                                        <td>
                                            @php
                                                $ratePart = $magentoOldRecord->rate_part;
                                                $words = explode(' ', $ratePart);
                                                $chunkedWords = array_chunk($words, 2); // Break after every 3 words
                                            @endphp

                                            @foreach($chunkedWords as $chunk)
                                                {{ implode(' ', $chunk) }}<br>
                                            @endforeach
                                        </td>
                                        <!-- <td>{{ $magentoOldRecord->pre_call_notes }}</td> -->
                                        <!-- <td>{{ $magentoOldRecord->meeting_link }}</td> -->
                                        <!-- <td>{{ $magentoOldRecord->post_call_notes }}</td> -->
                                        <!-- <td>{{ $magentoOldRecord->selected_rejected_note }}</td> -->
                                        <td>{{ $magentoOldRecord->interview_taken_by }}</td>
                                        <td>{{ $magentoOldRecord->technology }}</td>
                                        <!-- <td>{{ $magentoOldRecord->client_email_id }}</td> -->
                                        <!-- <td>{{ $magentoOldRecord->client_cell_no }}</td> -->
                                        <!-- <td>{{ $magentoOldRecord->created_at }}</td>
                                        <td>{{ $magentoOldRecord->updated_at }}</td> -->
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
        "lengthChange": true, // Set to true to allow changing the number of magentoOldRecords per page
        "lengthMenu": [10, 25, 50, 100, 500], // Define the options for the number of magentoOldRecords per page
        "autoWidth": false,
        "buttons": ["pdf"]
        // "order": [[0, "desc"]] 
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});

$(document).ready(function() {
    $('.select2').select2();
 
});

</script>

<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<script src="{{ asset('assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>
@endsection

   

