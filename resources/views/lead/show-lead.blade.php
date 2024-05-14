@extends('layouts.app')

@section('content')
@section('title', 'Lead')

<div class="page-wrapper">
	<div class="chat-main-row">
		<div class="chat-main-wrapper">
			<div class="col-lg-9 message-view task-view">
				<div class="chat-window">
					<div class="fixed-header">
						<div class="navbar">
							<div class="user-details mr-auto">
								<div class="float-left user-img m-r-10">
									<a href="#" title="Mike Litorus"><img src="assets/img/user.jpg"
											alt="" class="w-40 rounded-circle"><span
											class="status online"></span></a>
								</div>
								<div class="user-info float-left">
									<a href="#" title="Mike Litorus"><span class="font-bold">{{ $leadData->company_name }}</span> </a>
									<!-- <span class="Last-seen">Last seen today at 7:50 AM</span> -->
								</div>
							</div>
							
							<ul class="nav custom-menu">
								<li class="nav-item">
									<a href="#chat_sidebar"
										class="nav-link task-chat profile-rightbar float-right"><i
											class="fas fa-user" aria-hidden="true"></i></a>
								</li>
							</ul>
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
					<div class="chat-contents">
						<div class="chat-content-wrap">
							<div class="chat-wrap-inner">
								<div class="chat-box">
									<div class="chats">
									@foreach($leadHistories as $history)
									@if ($history->leadCreate_user_role == "Sales Team")
										<div class="chat chat-left">
											<div class="chat-avatar">
												<a href="profile.html" class="avatar">
													<img alt="John Doe" src="{{ asset('storage/' . $history->user->user_image) }}"
														class="img-fluid rounded-circle">
												</a>
												<h5>
													<small>{{ $history->leadCreate_user_name }}</small>
													<a href="profile.html"> <span>{{ $history->leadCreate_user_role }}</span></a>
												</h5>
												<small> 
													{{ \Carbon\Carbon::parse($history->created_at)->format('d M Y') }}
												</small>

											</div>
											<div class="chat-body">
												<div class="chat-bubble">
													<div class="chat-content">
														<p>{{ $history->comment }}</p>
														<span class="chat-time">{{ \Carbon\Carbon::parse($history->created_at)->format('h:i A') }}</span>

														<small>lead Status :</small>
														<i class="typing-text">{{ $history->leadStatus->leadstatusname }}</i>
														
													</div>
													<span></span>
												</div>
											</div>
										</div>
										@else
										<div class="chat chat-right">
											<div class="chat-avatar">
												<a href="profile.html" class="avatar">
													<img alt="John Doe" src="{{ asset('storage/' . $history->user->user_image) }}"
														class="img-fluid rounded-circle">
												</a>
												<h5>
													<small>{{ $history->leadCreate_user_name }}</small>
													<a href="profile.html">
															<small>
															{{ $history->leadCreate_user_role }}
															</small>
													</a>
												</h5>
												<small> 
													{{ \Carbon\Carbon::parse($history->created_at)->format('d M Y') }}
												</small>
											</div>
											<div class="chat-body">
												<div class="chat-bubble">
													<div class="chat-content">
														<p>{{ $history->comment }}</p>
														<span class="chat-time">{{ \Carbon\Carbon::parse($history->created_at)->format('h:i A') }}</span>

														<small>lead Status :</small>
														<i class="typing-text">{{ $history->leadStatus->leadstatusname }}</i>
														
													</div>
													<span></span>
												</div>
											</div>
										</div>
										@endif
									@endforeach

									</div>
								</div>
							</div>
						</div>
					</div>
					<form action="{{ route('comments.add') }}" method="POST">
						@csrf
						<input type="hidden" name="lead_id" value="{{ $history->lead_id }}">
						<div class="chat-footer">
							<div class="message-bar">
								<div class="message-inner">
									<div class="message-area">
										<div class="input-group">
											<input type="text" class="form-control" name="lead_comment" placeholder="Type a comment ..." required >
											<span class="input-group-append">
												<button class="btn btn-info" type="submit"><i class="fas fa-paper-plane"></i></button>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>

				</div>
			</div>
			<div class="col-lg-3 message-view chat-profile-view chat-sidebar" id="chat_sidebar">
				<div class="chat-window video-window">
					<div class="fixed-header">
						<ul class="nav nav-tabs nav-tabs-bottom">
							
							<li class="nav-item"><a class="nav-link active" href="#profile_tab"
									data-toggle="tab">Details</a></li>
						</ul>
					</div>
					<div class="tab-content chat-contents">
						<div class="content-full tab-pane show active" id="profile_tab">
							<div class="display-table">
								<div class="table-row">
									<div class="table-body">
										<div class="table-content">
											<div class="chat-profile-img">
												<div class="invoice-details">
													<img src="{{ asset('storage/' . $leadData->company->company_image) }}" class="inv-logo" alt="">
												</div>
												<br>
											
											</div>
											<div class="chat-profile-info">
												<ul class="user-det-list">
													<h3 class="text-uppercase">{{ $leadData->company->company_name }}</h3>
													<li><strong>Company Detals</strong></li>
													<li>
													company_email: <span class="float-right text-muted">{{ $leadData->company_email }}</span>
													</li>
													<li>
													company_phone: 
														<span class="float-right text-muted">{{ $leadData->company_phone }}</span>
													</li>
													<li>
													company_rate: 
														<span class="float-right text-muted">{{ $leadData->company_rate }}</span>
													</li>
													<li><strong> -- Detals --</strong></li>
													<li>
														<span>Technology:</span>
														<span class="float-right text-muted">{{ $leadData->vendor->technology->technology_name }}</span>
													</li>
													<li>
														<span>Vendor Name:</span>
														<span class="float-right text-muted">{{ $leadData->vendor->name }}</span>
													</li>
													<li>
														<span>Interviewer Name:</span>
														<span class="float-right text-muted">
														{{ $leadData->interviewer->firstname }} {{ $leadData->interviewer->lastname }}
														</span>
													</li>
													<li><strong>Lead Created date</strong></li>
													<li>
														Date: <span class="float-right text-muted">{{ \Carbon\Carbon::parse($leadData->lead_created_at)->format('F j, Y') }}</span>
													</li>
													<li>
														Time: <span class="float-right text-muted">{{ \Carbon\Carbon::parse($leadData->lead_created_at)->format('h:i A') }}</span>
													</li>
													<li><strong>Other Details</strong></li>

													<li>
														meeting_link:
														<span class="float-right text-muted">
															<span id="meetingLink">{{ $leadData->meeting_link }}</span>
															<button class="btn btn-sm btn-outline-primary" onclick="copyMeetingLink()">
																<i class="fas fa-copy"></i>
															</button>
														</span>
													</li>
													
													<li>source: <span class="float-right text-muted">{{ $leadData->source }}</span></li>
												</ul>

												<div class="col-sm-12 col-12 text-left add-btn-col">
													@if(auth()->user()->role != 3)
														<a href="{{ route('leads.edit', $leadData->id) }}" class="btn btn-warning float-right btn-rounded"><i class="far fa-edit"></i>Edit Lead </a>
														<a href="{{ route('view.lead') }}" class="btn btn-danger float-right btn-rounded"><i class="far fa-eye"></i>All Lead </a>
														<a href="{{ route('add.lead') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i>New Lead </a>
													@endif
												</div>
											</div>
										
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    function copyMeetingLink() {
        /* Get the text field */
        var meetingLink = document.getElementById("meetingLink");

        /* Select the text field */
        meetingLink.select();
        meetingLink.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        alert("Meeting link copied: " + meetingLink.value);
    }
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


