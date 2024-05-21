@extends('layouts.app')

@section('content')
@section('title', 'Lead')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">Create New Interviewee</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="add-card.php">Lead</a></li>
                        <li class="breadcrumb-item"><span> Add Interviewee</span></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-sm-12 col-12 text-left add-btn-col">
                 <a href="{{ route('interviewee.createInterviewee') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> Add New Interviewee </a>
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
        <div class="row">
            <div class="col-lg-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="page-title">
                                    Interviewee Lists
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
                                        <th>Interviewee Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Technology</th>
                                        <th>Status</th>
                                        <th>Comment</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                               
                                    @foreach($technologys as $technology)
                                    <tr>
                                        
                                        <td>{{ $technology->id }}</td>
                                        <td>{{ $technology->name }}</td>
                                        <td>{{ $technology->email }}</td>
                                        <td>{{ $technology->phone_number }}</td>
                                        @if(!empty($technology->technologyName))
                                            <td>{{ $technology->technologyName->technology_name }}</td>
                                            @else
                                                <td>No technology name</td>
                                        @endif
                                        <td
                                        @if($technology->status == 1)
                                     
                                             style="font-weight: bold; color: green;">
                                                {{ 'Active' }}
                                            @else
                                                style="font-weight: bold; color: red;">
                                                {{ 'Inactive' }}
                                            
                                            @endif
                                            </td>

                                        <td>{{ $technology->comment }}</td>
                                        <td>{{ $technology->created_at }}</td>
                                        <td class="text-right">
                                        <a href="{{ route('interviewee.editInterviewee', $technology->id) }}" class="btn btn-primary btn-sm mb-1">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <button type="submit" data-toggle="modal" data-target="#delete_leadstatus"
                                                class="btn btn-danger btn-sm mb-1">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                          
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

    <div id="delete_leadstatus" class="modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title">Interviewee Lead Status</h4>
                </div>
                @if(isset($technology->id))
                <form id="delete_leadstatus" action="{{ route('interviewee.deleteInterviewee', $technology->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure want to delete this?</p>
                        <div class="m-t-20">
                            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-danger" >Delete</button>
                        </div>
                    </div>
                </form>
                @else
                    <p>No technology found.</p>
                @endif
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


@endsection

   

