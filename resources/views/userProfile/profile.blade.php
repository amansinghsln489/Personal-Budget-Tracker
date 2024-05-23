@extends('layouts.app')

@section('content')
@section('title', 'Dashboard')

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <h5 class="text-uppercase mb-0 mt-0 page-title">my Profile</h5>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <ul class="breadcrumb float-right p-0 mb-0">
                            <li class="breadcrumb-item"><a href="indeX-2.html"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item"><span> Profile</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-box m-b-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="#"><img class="avatar" src="{{ asset('storage/' . $user->user_image) }}" alt=""></a>
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0">{{ $user->firstname }} {{ $user->lastname }}</h3>
                                            <h5 class="company-role m-t-0 m-b-0">{{ $roleName }} </h5>
                                            <small class="staff-id" style="font-weight: bold; color: {{ $user->user_status == 1 ? 'green' : 'red' }}">
                                               {{ $user->user_status == 1 ? 'Active' : $user->user_status }}
                                            </small>


                                            <div class="staff-id">Employee ID : {{ $user->employee_id }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            <li>
                                                <span class="title">Phone:</span>
                                                <span class="text"><a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></span>
                                            </li>
                                            <li>
                                                <span class="title">Email:</span>
                                                <span class="text"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></span>
                                            </li>
                                             <!-- <a href="{{ route('delete.role', $role->role_id) }}" class="btn btn-danger btn-sm mb-1">
                                            <i class="far fa-trash-alt"></i>
                                        </a> -->
                                        <li>
                                                <span class="title">change password:</span>
                                                <!-- <button type="submit" data-toggle="modal" data-target="#delete_role"
                                            class="btn btn-danger btn-sm mb-1">
                                            <i class="far fa-trash-alt"></i>
                                        </button> -->
                                        <button type="button" data-toggle="modal" data-target="#changePasswordModal"
                                            class="btn btn-danger btn-sm mb-1">
                                            <i class="fas fa-key"></i> Change Password
                                        </button>
                                            </li>
                                       
                                            <!-- You can add more fields here as needed -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('section/notification') 
    </div>
    <div id="changePasswordModal" class="modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div id="error_message" class="alert alert-danger" style="display: none;"></div>
            <form id="changePasswordModal_form">
                @csrf
                <div class="modal-body">
                    <!-- Hidden Field -->
                    <input type="hidden" id="user_id" name="user_id" value="{{ $user->user_id }}">
                    
                    <!-- Old Password -->
                    <div class="form-group">
                        <label for="old_password">Old Password</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" required>
                    </div>
                    
                    <!-- New Password -->
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    
                    <!-- Confirm New Password -->
                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        <small id="passwordMismatch" class="form-text text-danger" style="display: none;">New password and confirm password do not match.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="successModal" class="modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Success</h5>
            </div>
            <div class="modal-body">
                <p>Password changed successfully!</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="successOkButton" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- check password match -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#changePasswordModal_form').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var oldPassword = $('#old_password').val();
            var newPassword = $('#new_password').val();
            var confirmPassword = $('#confirm_password').val();
            var userId = $('#user_id').val();
            var passwordMismatchMessage = $('#passwordMismatch');
            var errorMessageElement = $('#error_message');

            // Client-side validation
            if (newPassword !== confirmPassword) {
                passwordMismatchMessage.show();
                return;
            } else {
                passwordMismatchMessage.hide();
            }

            // Send the form data via AJAX
            $.ajax({
                url: '/password', // URL to submit the form to
                method: "POST",
                data: {
                    _token: $('input[name="_token"]').val(),
                    user_id: userId,
                    old_password: oldPassword,
                    new_password: newPassword,
                    new_password_confirmation: confirmPassword,
                   
                },
                success: function(response) {
                    // Handle successful response
                    $('#changePasswordModal').modal('hide'); // Hide the change password modal
                    $('#successModal').modal('show');// Hide the modal
                    
                },
                error: function(response) {
                    var errorMessage = response.responseJSON?.error || 'An error occurred. Please try again.';
                    errorMessageElement.text(errorMessage); // Update error message element
                    errorMessageElement.show(); // Show error message
                }
            });
        });

        // Optionally, hide the message when the user starts typing in either field
        $('#new_password, #confirm_password').on('input', function() {
            $('#passwordMismatch').hide();
        });
        $('#successOkButton').click(function() {
            location.reload();
        });
    });
</script>



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

