@extends('layouts.app')

@section('content')
@section('title', 'Lead')

<div class="page-wrapper">
<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h5 class="text-uppercase mb-0 mt-0 page-title"> Update Lead</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <ul class="breadcrumb float-right p-0 mb-0">
                    <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="add-card.php">Lead</a></li>
                    <li class="breadcrumb-item"><span> Update Lead</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-12 col-12 text-left add-btn-col">
            <a href="{{ route('view.lead') }}" class="btn btn-danger float-right btn-rounded"><i class="far fa-eye"></i> View All Lead </a>
            <a href="{{ route('leads.show', $editLead->id) }}" class="btn btn-warning float-right btn-rounded"><i class="far fa-eye"></i>Show Comments </a>
            <a href="{{ route('add.lead') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> Add New Lead </a>
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
                                        Edit Lead Data
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
                        <form class="m-b-30" method="POST" action="{{ route('leads.update', $editLead->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                    <select class="form-control select2" name="company_id">
                                        <option value="">--Select Company--</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->company_id }}" {{ $editLead->company_id == $company->company_id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                                        @endforeach
                                    </select>
                                        <label class="focus-label">Company</label>
                                    </div>
                                </div>

                                <!-- <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <select class="form-control select2" name="technology_id">
                                            <option value="">--Select Technologies--</option>
                                            @foreach($technologies as $technology)
                                                <option value="{{ $technology->technology_id }}"{{ $editLead->technology_id ==  $technology->technology_id ? 'selected' : '' }}>{{ $technology->technology_name }}</option>
                                            @endforeach
                                        </select>
                                        <label class="focus-label">Technologies</label>
                                    </div>
                                </div> -->

                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <select class="form-control select2" name="vendor_id">
                                            <option value="">--Select vendor--</option>
                                            @foreach($vendors as $vendor)
                                                <option value="{{ $vendor->vendor_id }}"{{ $editLead->vendor_id ==  $vendor->vendor_id ? 'selected' : '' }}>{{ $vendor->name }} {{ $vendor->technology->technology_name }}<span style="color:red">{{ $vendor->role_name }}</span></option>
                                            @endforeach
                                        </select>
                                        <label class="focus-label">Vendors</label>
                                    </div>
                                </div>

                          
                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <select class="form-control select2" name="interviewee_id">
                                            <option value="">--Select Interviewee--</option>
                                            @foreach($interviewee_users as $interviewee_user)
                                                <option value="{{ $interviewee_user->user_id }}"{{ $editLead->interviewee_id ==  $interviewee_user->user_id ? 'selected' : '' }}>{{ $interviewee_user->firstname }} {{ $interviewee_user->lastname }} <span style="color:red">-{{ $interviewee_user->role_name }}</span> </option>
                                            @endforeach
                                        </select>
                                        <label class="focus-label">Interviewee</label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <input name="interview_date" class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker" value="{{ \Carbon\Carbon::parse($editLead->interview_date)->format('d-m-Y') }}">
                                        <label class="focus-label">Interview Date <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <select class="form-control select2" name="interview_status">
                                            <option value="">--Select--</option>
                                            @foreach($LeadStatuss as $LeadStatus)
                                                <option value="{{ $LeadStatus->leadstatusid }}"{{ $LeadStatus->leadstatusid ==  $editLead->interview_status ? 'selected' : '' }}>{{ $LeadStatus->leadstatusname }}</option>
                                            @endforeach
                                        </select>
                                        <label class="focus-label">Interview Status</label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <input name="company_email" class="form-control" type="company_email" placeholder="Email (Optional)" value="{{ $editLead->company_email }}">
                                        <label class="focus-label">Email (Optional)</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <input name="company_phone" class="form-control" type="tel" placeholder="Phone (Optional)" value="{{ $editLead->company_phone }}">
                                        <label class="focus-label">Phone (Optional)</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <input name="company_rate" class="form-control" type="number" placeholder="Rate (Optional)" value="{{ $editLead->company_rate }}">
                                        <label class="focus-label">Rate (Optional)</label>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group form-focus">
                                        <textarea name="meeting_link" class="form-control" placeholder="Meeting Link (Optional)">{{ $editLead->meeting_link }}</textarea>
                                        <label class="focus-label">Meeting Link (Optional)</label>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group form-focus">
                                        <input name="source" class="form-control" type="text" placeholder="Source" value="{{ $editLead->source }}">
                                        <label class="focus-label">Source</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-focus">
                                        <textarea name="lead_comment" class="form-control" rows="3" placeholder="Lead Comment" required >{{ $editLead->lead_comment }}</textarea>
                                        <label class="focus-label">Lead Comment</label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Update Lead</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6 d-flex">
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
                                    <th>Company</th>
                                    <th>Technologies</th>
                                    <th>Vendors</th>
                                    <th>Interviewee</th>
                                    <th>Created BY</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leads as $lead)
                                    <tr>
                                        <td>
                                            <i class="fa fa-building"></i> {{ mb_strimwidth($lead->company->company_name, 0, 18, '...') }}
                                        </td>
                              
                                        <td>
                                            {{ $lead->vendor->technology->technology_name }}
                                        </td>
                                        <td>
                                            {{ $lead->vendor->name }}
                                        </td>
                                           
                                        <td>
                                            {{ $lead->interviewer->firstname }} 
                                        </td>
                                    
                                        <td>
                                            {{ $lead->createdUser->firstname }} {{ $lead->createdUser->lastname }}
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
        "buttons": ["pdf"]
        // "order": [[0, "desc"]] 
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

<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection


