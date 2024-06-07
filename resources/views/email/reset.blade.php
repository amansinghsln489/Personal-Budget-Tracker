@extends('section.head')
<div class="main-wrapper">
    <div class="account-page">
        <div class="container">
            <h3 class="account-title text-center text-white">Change Password</h3>
            <div class="account-box">
                <div class="account-wrapper">
                    <div class="account-logo">
                        <a href="index.html"><img src="{{ asset('assets/img/logo1.png') }}" alt="SchoolAdmin"></a>
                    </div>
                    <form method="POST" action="{{ route('forgot_password_change_process') }}" onsubmit="return validatePasswords()">
                        @csrf
                        
                        <!-- <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" id="new-password" name="new_password" required>
                        </div> -->
                        <label>New Password</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1" onclick="togglePasswordVisibility('new-password', 'eye-new-password')">
                                <i class="fa fa-eye-slash" id="eye-new-password"></i>
                            </span>
                            <input type="password" class="form-control" name="new_password" aria-label="Password" aria-describedby="basic-addon1" id="new-password" required>
                        </div>
                        <!-- <div class="form-group">
                            <label>New Repeat Password</label>
                            <input type="password" class="form-control" id="repeat-password" name="repeat_password" required>
                        </div> -->
                        <label>New Repeat Password</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1" onclick="togglePasswordVisibility('repeat-password', 'eye-repeat-password')">
                                <i class="fa fa-eye-slash" id="eye-repeat-password"></i>
                            </span>
                            <input type="password" class="form-control" name="repeat_password" aria-label="Password" aria-describedby="basic-addon1" id="repeat-password" required>
                        </div>
                        <div id="password-error" class="text-danger"></div> <!-- Error message container -->
                        <div class="form-group m-b-0 text-center custom-mt-form-group">
                            <button class="btn btn-primary btn-block account-btn" type="submit">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>

<script>
    function validatePasswords() {
        const newPassword = document.getElementById('new-password').value;
        const repeatPassword = document.getElementById('repeat-password').value;
        const errorContainer = document.getElementById('password-error');
        
        if (newPassword !== repeatPassword) {
            errorContainer.textContent = 'Passwords do not match. Please try again.'; // Display error message
            return false;
        } else {
            errorContainer.textContent = ''; // Clear error message if passwords match
            return true;
        }
    }
    function togglePasswordVisibility(passwordId, eyeId) {
        const passwordField = document.getElementById(passwordId);
        const eyeIcon = document.getElementById(eyeId);
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    }
</script>
