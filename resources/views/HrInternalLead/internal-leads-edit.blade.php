@extends('layouts.app')

@section('content')
@section('title', 'Candidate')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">Update Information</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="add-card.php">Candidate</a></li>
                        <li class="breadcrumb-item"><span> Add Candidate</span></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-sm-12 col-12 text-left add-btn-col">
                <a href="{{ route('internal-leads.index') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> View All Candidates </a>
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
            <div class="col-lg-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="page-title">
                                            Update Candidate Information
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
                         
                            <form class="m-b-30" method="POST" action="{{ route('internal-leads.update',$internal_lead->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label>Candidate Name <span class="text-danger">*</span></label></strong>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="candidate_name" placeholder="Candidate Name" value="{{ $internal_lead->candidate_name }}" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label>Candidate Email <span class="text-danger">*</span></label></strong>
                                            <div class="input-group">
                                                <input type="email" class="form-control" name="candidate_email" placeholder="Candidate Email" value="{{  $internal_lead->candidate_email }}" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-envelope"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label>Candidate Mobile <span class="text-danger">*</span></label></strong>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="candidate_mobile" placeholder="Candidate Mobile" value="{{ $internal_lead->candidate_mobile }}" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-phone"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                                <strong><label>Interviewee</label></strong>
                                                <select class="form-control select2" name="interview">
                                                    <option value="">--Select--</option>
                                                    @foreach($interview_names as $interview_name)
                                                    <option value="{{ $interview_name->id }}"{{ $interview_name->id ==  $internal_lead->interviewee_id ? 'selected' : '' }}>{{ $interview_name->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                      
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                            <strong><label>Candidate Interview Feedback</label></strong>
                                            <textarea class="form-control" name="candidate_interview_feedback" rows="3"  placeholder="Candidate Interview Feedback">{{ $internal_lead->candidate_interview_feedback }}</textarea>
                                        </div>
                                    </div> 

                                </div>   

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label>Interview Date</label></strong>
                                            <div class="input-group">
                                                <input type="datetime-local" class="form-control" name="interview_date" value="{{ $internal_lead->interview_date }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label>Status</label></strong>
                                            <select class="form-control select2" name="status">
                                                <option value="">--Select--</option>
                                                @foreach($leadStatuss as $LeadStatus)
                                                    <option value="{{ $LeadStatus->leadstatusid }}"{{ $LeadStatus->leadstatusid ==  $internal_lead->status ? 'selected' : '' }}>{{ $LeadStatus->leadstatusname }}</option>
                                                @endforeach
                                              
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <strong><label>Additional Comments</label></strong>
                                            <textarea class="form-control" name="additional_comments" rows="3" placeholder="Additional Comments">{{ $internal_lead->additional_comments}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-t-20 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Update Candidate</button>
                                </div>
                            </form>
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
    $(document).ready(function() {
    $('.select2').select2();
});
</script>

<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<script src="{{ asset('assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>


@endsection
