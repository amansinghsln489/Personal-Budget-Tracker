<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>BT-Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
<script src="assets/js/jquery-3.6.0.min.js"></script>
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
    $(function(){
    
    $('#eye').click(function(){
           
          if($(this).hasClass('fa-eye-slash')){
               
            $(this).removeClass('fa-eye-slash');
              
            $(this).addClass('fa-eye');
              
            $('#password').attr('type','text');
                
          }else{
             
            $(this).removeClass('fa-eye');
              
            $(this).addClass('fa-eye-slash');  
             
            $('#password').attr('type','password');
          }
      });
  }); 
</script>
	<div class="main-wrapper">
		<div class="account-page">
			<div class="container">
				<h3 class="account-title text-white">BT-Login</h3>
				<div class="account-box">
					<div class="account-wrapper">
						<div class="account-logo">
							<a href=""><img src="{{ asset('assets/img/logo1.png') }}" alt="SchoolAdmin"></a>
						</div>
						<form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-eye-slash" id="eye"></i></span>
                                    <input type="password" class="form-control" name="password" aria-label="Password" aria-describedby="basic-addon1" id="password" required>
                                    </div>
                                <!-- <input type="password" id="password" name="password" class="form-control" required> -->   
                            </div>
                            <div class="form-group text-center custom-mt-form-group">
                                <button type="submit" class="btn btn-primary btn-block account-btn">Login</button>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('forgot-password') }}" class="btn btn-secondary btn-block account-btn">Forgot your password?</a>
                            </div>

                        </form>
                       
					</div>
				</div>
			</div>
		</div>
	</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>

   
</body>

</html>