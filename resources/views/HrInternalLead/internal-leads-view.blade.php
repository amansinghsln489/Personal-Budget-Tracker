@extends('layouts.app')

@section('content')
@section('title', 'Lead')


<style>
	.input-group.editer-box {
    width: 100%;
	justify-content: center;
}
.input-group.editer-box .ck.ck-editor {
    width: 93%;
}
.input-group.editer-box button.btn.btn-info.send-btn {
    height: 100%;
}
.input-group.editer-box .ck.ck-sticky-panel__content {
    display: none;
}
.user-det-list>li {
    display: flex;
    justify-content: space-between;
}
.user-det-list>li>span.float-right.text-muted {
    width: 60%;
}
</style>
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
											></span></a> 
								</div>
								<div class="user-info float-left">
									<a href="#" title="Mike Litorus"><span class="font-bold"></span> </a>
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
									@if ($history->leadCreate_user_role == "Human Resource")
									@if(!is_null($history->comment) && $history->comment !== '')
										<div class="chat chat-left">
											<div class="chat-avatar">
											@if($history->user_image)
											   <a href="" class="avatar">
													<img alt="John Doe" src="{{ asset('storage/' . $history->userName->user_image) }}" class="img-fluid rounded-circle">
												</a>
												@else
													<span class="avatar">{{ strtoupper(substr($user->firstname, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}</span>
												@endif
											
												
												<h5>
													<small>{{ $history->leadCreate_user_name }}</small>
													<a href=""> <span>{{ $history->leadCreate_user_role }}</span></a>
												</h5>
												<small> 
													{{ \Carbon\Carbon::parse($history->created_at)->format('d M Y') }}
												</small>

											</div>
											
											<div class="chat-body">
												<div class="chat-bubble">
													<div class="chat-content">
													
														<p><?php echo $comments=$history->comment ?></p>
														<span class="chat-time">{{ \Carbon\Carbon::parse($history->created_at)->format('h:i A') }}</span>

														<small>Candidate Status :</small>
														@if(optional($history->leadStatus)->leadstatusname)
														<i class="typing-text">{{ $history->leadStatus->leadstatusname }}</i>
														@endif
													</div>
													<span></span>
												</div>
											</div>
										</div>
										@endif
										@else
										<div class="chat chat-right">
											<div class="chat-avatar">


											@if($user->user_image)
											   <a href="" class="avatar">
													<img alt="John Doe" src="{{ asset('storage/' . $history->userName->user_image) }}"
														class="img-fluid rounded-circle">
												</a>
												@else
													<span class="avatar">{{ strtoupper(substr($user->firstname, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}</span>
												@endif
												
												<h5>
													<small>{{ $history->leadCreate_user_name }}</small>
													<a href="">
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
									                    
														<div><?php echo $comments=$history->comment ?></div>
														<span class="chat-time">{{ \Carbon\Carbon::parse($history->created_at)->format('h:i A') }}</span>
														<small>Candidate Status :</small>
														@if(optional($history->leadStatus)->leadstatusname)
															<i class="typing-text">{{ $history->leadStatus->leadstatusname }}</i>
														@endif
														
														
														
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
                    @foreach($leadDatas as $leadData)
					<form action="{{ route('comment.add') }}" method="POST">
						@csrf
						<input type="hidden" name="lead_id" value="{{ $leadData->id }}">
						<div class="chat-footer">
							<div class="message-bar">
								<div class="message-inner">
									<div class="message-area">
										<div class="input-group editer-box">
										<textarea class="form-control" name="lead_comment" rows="3"  placeholder="Candidate Interview Feedback"></textarea>
											<span class="input-group-append">
												<button class="btn btn-info send-btn" type="submit"><i class="fas fa-paper-plane"></i></button>
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
											
											<div class="chat-profile-info">
                                          
												<ul class="user-det-list">
													<h3 class="text-uppercase">Candidate Details</h3>
													
													<li>
													Candidate Name: <span class="float-right text-muted">{{ $leadData->candidate_name }}</span>
													</li>
													<li>
													Phone Number: 
														<span class="float-right text-muted">{{ $leadData->candidate_mobile }}</span>
													</li>
													
													<li>
													Email: 
														<span class="float-right text-muted">{{ $leadData->candidate_email }}</span>
													</li>
													<li>
													Working Experience : 
														<span class="float-right text-muted">{{ $leadData->experienceYear->experience }}</span>
													</li>
													<li><strong> -- Details --</strong></li>
													<li>
														<span>Technology:</span>
														<span class="float-right text-muted">{{ $leadData->technology->technology_name }}</span>
													</li>
													<li>
														<span>Interviewer Name:</span>
														<span class="float-right text-muted">{{ $leadData->intervieweeName->firstname }} {{ $leadData->intervieweeName->lastname}}</span>
													</li>
													<li>
														<span>Created Candidate:</span>
														<span class="float-right text-muted">
														{{ $leadData->userName->firstname}} {{ $leadData->userName->lastname}} 
														</span>
													</li>
													
													<li>
                                                    <span>Resume</span>
                                                    <span class="float-right text-muted">
                                                        @if($leadData->resume)
														@php
															$extension = pathinfo($leadData->resume, PATHINFO_EXTENSION);
														@endphp

														@if (in_array($extension, ['pdf']))
														<a href="{{ asset('storage/' . $leadData->resume) }}" target="_blank">
															<img src="{{ asset('assets/img/pdf.png') }}" alt="Pdf" style="height:30px;"/>
															View
															<i class="fas fa-download"></i>
														</a>
														@elseif(in_array($extension, ['docx']))  
														<a href="{{ asset('storage/' . $leadData->resume) }}" target="_blank">
															<img src="{{ asset('assets/img/docx.png') }}" alt="docx" style="height:30px;"/>
															Download
															<i class="fas fa-download"></i>
														</a>
														@endif
														
                                                            @else
                                                            Not upload resume
                                                        @endif
													</span>
													</li>
                                                   
													<li>
                                                    <span> Interview Date</span>
                                                    <span class="float-right text-muted">
													{{ \Carbon\Carbon::parse($leadData->interview_date)->format('d-M-Y h:i:s A')}}
														
												    </span>
													</li>
													<li>
                                                    <span>Status</span>
                                                    <span class="float-right text-muted">
														{{ $leadData->leadStatus->leadstatusname }} 
														</span>
													</li>
													@if($leadData->additional_comments)
													<li>
                                                    <span> Additional Comments</span>
                                                    <span class="float-right text-muted">
													<textarea name="lead_comment" class="form-control" rows="2" readonly data-toggle="popover" title="Lead  Comments" data-content="{{ $leadData->additional_comments }}">{{ $leadData->additional_comments }}</textarea>

														</span>
													</li>
													@endif
													
												</ul>
                                                @endforeach

												<div class="col-sm-12 col-12 text-left add-btn-col">
													@if(auth()->user()->role != 3)
														<a href="{{ route('internal-leads.edit', $leadData->id) }}" class="btn btn-warning float-right btn-rounded"><i class="far fa-edit"></i>Edit  </a>
														<a href="{{ route('internal-leads.index') }}" class="btn btn-danger float-right btn-rounded"><i class="far fa-eye"></i>All  </a>
														<a href="{{ route('internal-leads.create') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i>New </a>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
        ClassicEditor
            .create(document.querySelector('textarea[name="lead_comment"]'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection


