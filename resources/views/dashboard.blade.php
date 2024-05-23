@extends('layouts.app')

@section('content')
@section('title', 'Dashboard')

<div class="page-wrapper">
	<div class="content container-fluid">

		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
					<h3 class="page-title mb-0">Dashboard</h3>
				</div>
				<div class="col-md-6">
					<ul class="breadcrumb mb-0 p-0 float-right">
						<li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item"><span>Dashboard</span></li>
					
					</ul>
					<!--<p><i aria-hidden="true" class="fas fa-calendar-alt"></i> December 6, 2018</p>-->
				</div>
			</div>
		</div>
		
		<!--
		|--------------------------------------------------------------------------
		| sales team Dashboard
		|--------------------------------------------------------------------------
		-->
			@if ($user->role == 2)
				@include('dashboard.salesTeamDashboard')
		
		<!--
		|--------------------------------------------------------------------------
		| Interviee Dashboard
		|--------------------------------------------------------------------------
		-->
			@elseif ($user->role == 3)
				@include('dashboard.IntervieeTeamDashboard')
			
		<!--
		|--------------------------------------------------------------------------
		| All Adminstrator Dashboard
		|--------------------------------------------------------------------------
		-->
			@else
				@include('dashboard.AdminstratorTeamDashboard')
			@endif
		<!--
		|--------------------------------------------------------------------------
		| Sales Team Today Lead 
		|--------------------------------------------------------------------------
		-->

		<!-- <div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-sm-6">
								<div class="page-title">
									Today All Leads
								</div>
							</div>
							<div class="col-sm-6 text-sm-right">
								<div class=" mt-sm-0 mt-2">
									<button class="btn btn-outline-primary mr-2"><img src="assets/img/excel.png"
											alt=""><span class="ml-2">Excel</span></button>
									<button class="btn btn-outline-danger mr-2"><img src="assets/img/pdf.png"
											alt="" height="18"><span class="ml-2">PDF</span></button>
									<button class="btn btn-light" type="button" data-toggle="dropdown"
										aria-haspopup="true" aria-expanded="false"><i
											class="fas fa-ellipsis-h"></i></button>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="#">Action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Another action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Something else here</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="table-responsive">
									<table class="table custom-table">
										<thead class="thead-light">
											<tr>
												<th>Name </th>
												<th>Student ID</th>
												<th>Parent Name</th>
												<th>Mobile</th>
												<th>Address</th>
												<th>Date Of Admition</th>
												<th>Fees Receipt</th>
												<th class="text-right">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<h2><a href="profile.html" class="avatar text-white"><img
																src="assets/img/profile/img-1.jpg" alt=""></a><a
															href="profile.html">Parker <span></span></a></h2>
												</td>
												<td>ST-0d001</td>
												<td>Mr. Johnson</td>
												<td>973-584-58700</td>
												<td>9946 Baker Rd. Marysville, </td>
												<td>20/1/2021</td>
												<td><img src="assets/img/pdf.png" alt=""></td>
												<td class="text-right">
													<a href="edit-student.html"
														class="btn btn-primary btn-sm mb-1">
														<i class="far fa-edit"></i>
													</a>
													<button type="submit" data-toggle="modal"
														data-target="#delete_employee"
														class="btn btn-danger btn-sm mb-1">
														<i class="far fa-trash-alt"></i>
													</button>
												</td>
											</tr>
											<tr>
												<td>
													<h2><a href="profile.html" class="avatar text-white"><img
																src="assets/img/profile/img-2.jpg" alt=""></a><a
															href="profile.html">Smith <span></span></a></h2>
												</td>
												<td>ST-0d002</td>
												<td>Mr. Luke Idaman</td>
												<td>973-584-58700</td>
												<td>193 S. Harrison Drive </td>
												<td>20/1/2021</td>
												<td><img src="assets/img/pdf.png" alt=""></td>
												<td class="text-right">
													<a href="edit-student.html"
														class="btn btn-primary btn-sm mb-1">
														<i class="far fa-edit"></i>
													</a>
													<button type="submit" data-toggle="modal"
														data-target="#delete_employee"
														class="btn btn-danger btn-sm mb-1">
														<i class="far fa-trash-alt"></i>
													</button>
												</td>
											</tr>
											<tr>
												<td>
													<h2><a href="profile.html" class="avatar text-white"><img
																src="assets/img/profile/img-3.jpg" alt=""></a><a
															href="profile.html">Hensley<span></span></a></h2>
												</td>
												<td>ST-0d003</td>
												<td>Mr. Kevin H</td>
												<td>973-584-58700</td>
												<td>8949 Golf St. Palm Coast </td>
												<td>20/1/2021</td>
												<td><img src="assets/img/pdf.png" alt=""></td>
												<td class="text-right">
													<a href="edit-student.html"
														class="btn btn-primary btn-sm mb-1">
														<i class="far fa-edit"></i>
													</a>
													<button type="submit" data-toggle="modal"
														data-target="#delete_employee"
														class="btn btn-danger btn-sm mb-1">
														<i class="far fa-trash-alt"></i>
													</button>
												</td>
											</tr>
											<tr>
												<td>
													<h2><a href="profile.html" class="avatar text-white"><img
																src="assets/img/profile/img-4.jpg" alt=""></a><a
															href="profile.html">Friesen<span></span></a></h2>
												</td>
												<td>ST-0d004</td>
												<td>Mr. Randy O</td>
												<td>973-584-58700</td>
												<td>23 Ohio Court Alexandria </td>
												<td>20/1/2021</td>
												<td><img src="assets/img/pdf.png" alt=""></td>
												<td class="text-right">
													<a href="edit-student.html"
														class="btn btn-primary btn-sm mb-1">
														<i class="far fa-edit"></i>
													</a>
													<button type="submit" data-toggle="modal"
														data-target="#delete_employee"
														class="btn btn-danger btn-sm mb-1">
														<i class="far fa-trash-alt"></i>
													</button>
												</td>
											</tr>
											<tr>
												<td>
													<h2><a href="profile.html" class="avatar text-white"><img
																src="assets/img/profile/img-5.jpg" alt=""></a><a
															href="profile.html">Jackson<span></span></a></h2>
												</td>
												<td>ST-0d005</td>
												<td>Mr. Steven</td>
												<td>973-584-58700</td>
												<td>338 North Cleveland Rd </td>
												<td>20/1/2021</td>
												<td><img src="assets/img/pdf.png" alt=""></td>
												<td class="text-right">
													<a href="edit-student.html"
														class="btn btn-primary btn-sm mb-1">
														<i class="far fa-edit"></i>
													</a>
													<button type="submit" data-toggle="modal"
														data-target="#delete_employee"
														class="btn btn-danger btn-sm mb-1">
														<i class="far fa-trash-alt"></i>
													</button>
												</td>
											</tr>
											<tr>
												<td>
													<h2><a href="profile.html" class="avatar text-white"><img
																src="assets/img/profile/img-6.jpg" alt=""></a><a
															href="profile.html">Mason<span></span></a></h2>
												</td>
												<td>ST-0d006</td>
												<td>Mr. Ervin</td>
												<td>973-584-58700</td>
												<td>7909 W. Sunnyslope St. </td>
												<td>20/1/2021</td>
												<td><img src="assets/img/pdf.png" alt=""></td>
												<td class="text-right">
													<a href="edit-student.html"
														class="btn btn-primary btn-sm mb-1">
														<i class="far fa-edit"></i>
													</a>
													<button type="submit" data-toggle="modal"
														data-target="#delete_employee"
														class="btn btn-danger btn-sm mb-1">
														<i class="far fa-trash-alt"></i>
													</button>
												</td>
											</tr>
											<tr>
												<td>
													<h2><a href="profile.html" class="avatar text-white"><img
																src="assets/img/profile/img-7.jpg" alt=""></a>
														<a href="profile.html">Garrett <span></span></a>
													</h2>
												</td>
												<td>ST-0d007</td>
												<td>Mr. Marquz</td>
												<td>973-584-58700</td>
												<td>7361 Dunbar Street </td>
												<td>20/1/2021</td>
												<td><img src="assets/img/pdf.png" alt=""></td>
												<td class="text-right">
													<a href="edit-student.html"
														class="btn btn-primary btn-sm mb-1">
														<i class="far fa-edit"></i>
													</a>
													<button type="submit" data-toggle="modal"
														data-target="#delete_employee"
														class="btn btn-danger btn-sm mb-1">
														<i class="far fa-trash-alt"></i>
													</button>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="dash-widget dash-widget5">
					<span class="float-left"><img src="assets/img/dash/dash-1.png" alt="" width="80"></span>
					<div class="dash-widget-info text-right">
						<span>Total Lead</span>
						<h3>60,000</h3>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="dash-widget dash-widget5">
					<div class="dash-widget-info text-left d-inline-block">
						<span>Today Lead</span>
						<h3>12,000</h3>
					</div>
					<span class="float-right"><img src="assets/img/dash/dash-2.png" width="80" alt=""></span>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="dash-widget dash-widget5">
					<span class="float-left"><img src="assets/img/dash/dash-3.png" alt="" width="80"></span>
					<div class="dash-widget-info text-right">
						<span>Processsed Lead</span>
						<h3>20,000</h3>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="dash-widget dash-widget5">
					<div class="dash-widget-info d-inline-block text-left">
						<span>Closed lead</span>
						<h3>20,000</h3>
					</div>
					<span class="float-right"><img src="assets/img/dash/dash-4.png" alt="" width="80"></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 d-flex">
				<div class="card flex-fill">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-auto">
								<div class="page-title">
									Lead Survay
								</div>
							</div>
							<div class="col text-right">
								<div class=" mt-sm-0 mt-2">
									<button class="btn btn-light" type="button" data-toggle="dropdown"
										aria-haspopup="true" aria-expanded="false"><i
											class="fas fa-ellipsis-h"></i></button>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="#">Action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Another action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Something else here</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div id="chart1"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 d-flex">
				<div class="card flex-fill">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-auto">
								<div class="page-title">
									Lead Performance
								</div>
							</div>
							<div class="col text-right">
								<div class=" mt-sm-0 mt-2">
									<button class="btn btn-light" type="button" data-toggle="dropdown"
										aria-haspopup="true" aria-expanded="false"><i
											class="fas fa-ellipsis-h"></i></button>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="#">Action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Another action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Something else here</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div id="chart2"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-12 col-12 d-flex">
				<div class="card flex-fill">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-auto">
								<div class="page-title">
									Events
								</div>
							</div>
							<div class="col text-right">
								<div class=" mt-sm-0 mt-2">
									<button class="btn btn-light" type="button" data-toggle="dropdown"
										aria-haspopup="true" aria-expanded="false"><i
											class="fas fa-ellipsis-h"></i></button>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="#">Action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Another action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Something else here</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body dashboard-calendar">
						<div id="calendar" class=" overflow-hidden"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12 col-12 d-flex">
				<div class="card flex-fill">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-auto">
								<div class="page-title">
									Total Member
								</div>
							</div>
							<div class="col text-right">
								<div class=" mt-sm-0 mt-2">
									<button class="btn btn-light" type="button" data-toggle="dropdown"
										aria-haspopup="true" aria-expanded="false"><i
											class="fas fa-ellipsis-h"></i></button>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="#">Action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Another action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Something else here</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body d-flex align-items-center justify-content-center overflow-hidden">
						<div id="chart3"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-12 col-12 d-flex">
				<div class="card flex-fill">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-auto">
								<div class="page-title">
									Income Monthwise
								</div>
							</div>
							<div class="col text-right">
								<div class=" mt-sm-0 mt-2">
									<button class="btn btn-light" type="button" data-toggle="dropdown"
										aria-haspopup="true" aria-expanded="false"><i
											class="fas fa-ellipsis-h"></i></button>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="#">Action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Another action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Something else here</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div id="chart4"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 d-flex">
				<div class="card flex-fill">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-auto">
								<div class="page-title">
									Exam List
								</div>
							</div>
							<div class="col text-right">
								<div class=" mt-sm-0 mt-2">
									<button class="btn btn-light" type="button" data-toggle="dropdown"
										aria-haspopup="true" aria-expanded="false"><i
											class="fas fa-ellipsis-h"></i></button>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="#">Action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Another action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Something else here</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table custom-table">
										<thead class="thead-light">
											<tr>
												<th>Exam Name </th>
												<th>Subject</th>
												<th>Class</th>
												<th>Section</th>
												<th>Time</th>
												<th>Date</th>
												<th class="text-right">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<a href="exam-detail.html" class="avatar bg-green">C</a>
												</td>
												<td>English</td>
												<td>5</td>
												<td>B</td>
												<td>10.00am</td>
												<td>20/1/2019</td>
												<td class="text-right">
													<a href="edit-exam.html"
														class="btn btn-primary btn-sm mb-1">
														<i class="far fa-edit"></i>
													</a>
													<button type="submit" data-toggle="modal"
														data-target="#delete_employee"
														class="btn btn-danger btn-sm mb-1">
														<i class="far fa-trash-alt"></i>
													</button>
												</td>
											</tr>
											<tr>
												<td>
													<a href="exam-detail.html" class="avatar bg-purple">C</a>
												</td>
												<td>English</td>
												<td>4</td>
												<td>A</td>
												<td>10.00am</td>
												<td>2/1/2019</td>
												<td class="text-right">
													<a href="edit-exam.html"
														class="btn btn-primary btn-sm mb-1">
														<i class="far fa-edit"></i>
													</a>
													<button type="submit" data-toggle="modal"
														data-target="#delete_employee"
														class="btn btn-danger btn-sm mb-1">
														<i class="far fa-trash-alt"></i>
													</button>
												</td>
											</tr>
											<tr>
												<td>
													<a href="exam-detail.html" class="avatar bg-green">C</a>
												</td>
												<td>Maths</td>
												<td>6</td>
												<td>B</td>
												<td>10.00am</td>
												<td>2/1/2019</td>
												<td class="text-right">
													<a href="edit-exam.html"
														class="btn btn-primary btn-sm mb-1">
														<i class="far fa-edit"></i>
													</a>
													<button type="submit" data-toggle="modal"
														data-target="#delete_employee"
														class="btn btn-danger btn-sm mb-1">
														<i class="far fa-trash-alt"></i>
													</button>
												</td>
											</tr>
											<tr>
												<td>
													<a href="exam-detail.html" class="avatar bg-dark">C</a>
												</td>
												<td>Science</td>
												<td>3</td>
												<td>B</td>
												<td>10.00am</td>
												<td>20/1/2019</td>
												<td class="text-right">
													<a href="edit-exam.html"
														class="btn btn-primary btn-sm mb-1">
														<i class="far fa-edit"></i>
													</a>
													<button type="submit" data-toggle="modal"
														data-target="#delete_employee"
														class="btn btn-danger btn-sm mb-1">
														<i class="far fa-trash-alt"></i>
													</button>
												</td>
											</tr>
											<tr>
												<td>
													<a href="exam-detail.html" class="avatar bg-green">C</a>
												</td>
												<td>Maths</td>
												<td>6</td>
												<td>B</td>
												<td>10.00am</td>
												<td>20/1/2019</td>
												<td class="text-right">
													<a href="edit-exam.html"
														class="btn btn-primary btn-sm mb-1">
														<i class="far fa-edit"></i>
													</a>
													<button type="submit" data-toggle="modal"
														data-target="#delete_employee"
														class="btn btn-danger btn-sm mb-1">
														<i class="far fa-trash-alt"></i>
													</button>
												</td>
											</tr>
											<tr>
												<td>
													<a href="exam-detail.html" class="avatar bg-dark">C</a>
												</td>
												<td>English</td>
												<td>7</td>
												<td>B</td>
												<td>10.00am</td>
												<td>20/1/2019</td>
												<td class="text-right">
													<a href="edit-exam.html"
														class="btn btn-primary btn-sm mb-1">
														<i class="far fa-edit"></i>
													</a>
													<button type="submit" data-toggle="modal"
														data-target="#delete_employee"
														class="btn btn-danger btn-sm mb-1">
														<i class="far fa-trash-alt"></i>
													</button>
												</td>
											</tr>
											<tr>
												<td>
													<a href="exam-detail.html" class="avatar bg-purple">C</a>
												</td>
												<td>Science</td>
												<td>5</td>
												<td>B</td>
												<td>10.00am</td>
												<td>20/1/2019</td>
												<td class="text-right">
													<a href="edit-exam.html"
														class="btn btn-primary btn-sm mb-1">
														<i class="far fa-edit"></i>
													</a>
													<button type="submit" data-toggle="modal"
														data-target="#delete_employee"
														class="btn btn-danger btn-sm mb-1">
														<i class="far fa-trash-alt"></i>
													</button>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-sm-6">
								<div class="page-title">
									All Students
								</div>
							</div>
							<div class="col-sm-6 text-sm-right">
								<div class=" mt-sm-0 mt-2">
									<button class="btn btn-outline-primary mr-2"><img src="assets/img/excel.png"
											alt=""><span class="ml-2">Excel</span></button>
									<button class="btn btn-outline-danger mr-2"><img src="assets/img/pdf.png"
											alt="" height="18"><span class="ml-2">PDF</span></button>
									<button class="btn btn-light" type="button" data-toggle="dropdown"
										aria-haspopup="true" aria-expanded="false"><i
											class="fas fa-ellipsis-h"></i></button>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="#">Action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Another action</a>
										<div role="separator" class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Something else here</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table custom-table">
								<thead class="thead-light">
									<tr>
										<th>Name </th>
										<th>Student ID</th>
										<th>Class</th>
										<th>Section</th>
										<th>Mobile</th>
										<th>Date of Birth</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<h2><a href="profile.html" class="avatar text-white"><img
														src="assets/img/profile/img-1.jpg" alt=""></a><a
													href="profile.html">Parker <span></span></a></h2>
										</td>
										<td>ST-0d001</td>
										<td>1</td>
										<td>A</td>
										<td>973-584-58700</td>
										<td>20/1/2021</td>
										<td class="text-right">
											<a href="edit-student.html" class="btn btn-primary btn-sm mb-1">
												<i class="far fa-edit"></i>
											</a>
											<button type="submit" data-toggle="modal"
												data-target="#delete_employee"
												class="btn btn-danger btn-sm mb-1">
												<i class="far fa-trash-alt"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td>
											<h2><a href="profile.html" class="avatar text-white"><img
														src="assets/img/profile/img-2.jpg" alt=""></a><a
													href="profile.html">Smith <span></span></a></h2>
										</td>
										<td>ST-0d002</td>
										<td>2</td>
										<td>B</td>
										<td>973-584-58700</td>
										<td>20/1/2021</td>
										<td class="text-right">
											<a href="edit-student.html" class="btn btn-primary btn-sm mb-1">
												<i class="far fa-edit"></i>
											</a>
											<button type="submit" data-toggle="modal"
												data-target="#delete_employee"
												class="btn btn-danger btn-sm mb-1">
												<i class="far fa-trash-alt"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td>
											<h2><a href="profile.html" class="avatar text-white"><img
														src="assets/img/profile/img-3.jpg" alt=""></a><a
													href="profile.html">Hensley<span></span></a></h2>
										</td>
										<td>ST-0d003</td>
										<td>1</td>
										<td>A</td>
										<td>973-584-58700</td>
										<td>20/1/2021</td>
										<td class="text-right">
											<a href="edit-student.html" class="btn btn-primary btn-sm mb-1">
												<i class="far fa-edit"></i>
											</a>
											<button type="submit" data-toggle="modal"
												data-target="#delete_employee"
												class="btn btn-danger btn-sm mb-1">
												<i class="far fa-trash-alt"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td>
											<h2><a href="profile.html" class="avatar text-white"><img
														src="assets/img/profile/img-4.jpg" alt=""></a><a
													href="profile.html">Friesen<span></span></a></h2>
										</td>
										<td>ST-0d004</td>
										<td>1</td>
										<td>A</td>
										<td>973-584-58700</td>
										<td>20/1/2021</td>
										<td class="text-right">
											<a href="edit-student.html" class="btn btn-primary btn-sm mb-1">
												<i class="far fa-edit"></i>
											</a>
											<button type="submit" data-toggle="modal"
												data-target="#delete_employee"
												class="btn btn-danger btn-sm mb-1">
												<i class="far fa-trash-alt"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td>
											<h2><a href="profile.html" class="avatar text-white"><img
														src="assets/img/profile/img-5.jpg" alt=""></a><a
													href="profile.html">Jackson<span></span></a></h2>
										</td>
										<td>ST-0d005</td>
										<td>1</td>
										<td>A</td>
										<td>973-584-58700</td>
										<td>20/1/2021</td>
										<td class="text-right">
											<a href="edit-student.html" class="btn btn-primary btn-sm mb-1">
												<i class="far fa-edit"></i>
											</a>
											<button type="submit" data-toggle="modal"
												data-target="#delete_employee"
												class="btn btn-danger btn-sm mb-1">
												<i class="far fa-trash-alt"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td>
											<h2><a href="profile.html" class="avatar text-white"><img
														src="assets/img/profile/img-6.jpg" alt=""></a><a
													href="profile.html">Mason<span></span></a></h2>
										</td>
										<td>ST-0d006</td>
										<td>1</td>
										<td>A</td>
										<td>973-584-58700</td>
										<td>20/1/2021</td>
										<td class="text-right">
											<a href="edit-student.html" class="btn btn-primary btn-sm mb-1">
												<i class="far fa-edit"></i>
											</a>
											<button type="submit" data-toggle="modal"
												data-target="#delete_employee"
												class="btn btn-danger btn-sm mb-1">
												<i class="far fa-trash-alt"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td>
											<h2><a href="profile.html" class="avatar text-white"><img
														src="assets/img/profile/img-7.jpg" alt=""></a><a
													href="profile.html">Garrett <span></span></a></h2>
										</td>
										<td>ST-0d007</td>
										<td>1</td>
										<td>A</td>
										<td>973-584-58700</td>
										<td>20/1/2021</td>
										<td class="text-right">
											<a href="edit-student.html" class="btn btn-primary btn-sm mb-1">
												<i class="far fa-edit"></i>
											</a>
											<button type="submit" data-toggle="modal"
												data-target="#delete_employee"
												class="btn btn-danger btn-sm mb-1">
												<i class="far fa-trash-alt"></i>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div> -->
	    <div class="page-header">
          <div class="row">
				<div class="col-md-6">
					<h3 class="page-title mb-0">Total Interview</h3>
				</div>
          </div>
       </div>
	<div class="row">
        @php
        // Define an array of light background colors
        $backgroundColors = ['#ffe5e5', '#e5ffe5', '#e5e5ff', '#ffffcc', '#ccffff'];
        $colorIndex = 0;
        @endphp
        @foreach($totalInterviews as $totalInterview)
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <a href="">
                    <div class="dash-widget dash-widget5" style="background-color: {{ $backgroundColors[$colorIndex % count($backgroundColors)] }};">
                        
						<div class="dash-widget-info text-right">
                        <strong><span>Total Interview {{ $totalInterview->technology->technology_name }}  : {{ $totalInterview->total }}</span></strong>
                        <h5>Total Condidate Selected {{ $totalInterview->technology->technology_name }}    : {{ $totalInterview->selected_total }} </h5>
                        <span>Total Condidate Rejected : {{ $totalInterview->technology->technology_name }}  : {{ $totalInterview->unselected_total }} </span>
                    </div>
                    </div>
                </a>
            </div>
            @php
                $colorIndex++;
            @endphp
        @endforeach	
    </div>
	
		@include('section/notification') 
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

