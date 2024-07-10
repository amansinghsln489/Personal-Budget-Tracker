<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from preadmin-lite.dreamguystech.com/school/light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jul 2022 10:59:24 GMT -->

<head>
	<meta charset="utf-8">
	<title>Preschool - Bootstrap Admin Template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">

	<link rel="stylesheet" href="assets/css/fullcalendar.min.css">

	<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

	<link rel="stylesheet" href="assets/plugins/morris/morris.css">

	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
	<div class="main-wrapper">
		<div class="header-outer">
			<div class="header">
				<ul class="nav user-menu float-right">
					<li class="nav-item dropdown d-none d-sm-block">
						<div class="dropdown-menu notifications">
							<div class="drop-scroll">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="John Doe" src="assets/img/user-06.jpg"
														class="img-fluid rounded-circle">
												</span>
											</div>
										</a>
									</li>	
								</ul>
							</div>
						</div>
					</li>
					<li class="nav-item dropdown has-arrow">
						<a href="#" class=" nav-link user-link" data-toggle="dropdown">
							<span class="user-img"><img class="rounded-circle" src="assets/img/user-06.jpg" width="30"
									alt="Admin">
								<span class="status online"></span></span>
							<span>Admin</span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{route('logout')}}">Logout</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="sidebar" id="sidebar">
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<div class="header-left">
						<a href="index.html" class="logo">
							
							<span class="text-uppercase"> Budget Tracker</span>
						</a>
					</div>
					<ul class="sidebar-ul">
						<li class="menu-title">Menu</li>
						<li class="active">
							<a href=""><img src="assets/img/sidebar/icon-1.png"
								alt="icon"><span>Dashboard</span></a>
						</li>
							</ul>
						</li>
						<li>
							<a href="calendar.html"><img src="assets/img/sidebar/icon-9.png" alt="icon"><span>
									Events</span></a>
						</li>
						<li class="submenu">
							<a href="#"><img src="assets/img/sidebar/icon-10.png" alt="icon"><span> Accounts </span>
								<span class="menu-arrow"></span></a>
							<ul class="list-unstyled" style="display: none;">
							<li><a href="{{ route('expance.index') }}"><span>Expenses</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-wrapper">
			<div class="content container-fluid">

				<div class="page-header">
					<div class="row">
						<div class="col-md-6">
							<h3 class="page-title mb-0">Personal Budget Tracker</h3>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
						<div class="dash-widget dash-widget5">
							<div class="dash-widget-info text-left d-inline-block">
								<span>Expenses</span>
								<h3>{{ number_format($expense, 2) }}</h3>
							</div>
							<span class="float-right"><img src="assets/img/dash/dash-2.png" width="80" alt=""></span>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
						<div class="dash-widget dash-widget5">
							<span class="float-left"><img src="assets/img/dash/dash-3.png" alt="" width="80"></span>
							<div class="dash-widget-info text-right">
								<span>Income</span>
								<h3>{{ number_format($income, 2) }}</h3>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
						<div class="dash-widget dash-widget5">
							<div class="dash-widget-info d-inline-block text-left">
								<span>Total</span>
								<h3>{{ number_format($total, 2) }}</h3>
							</div>
							<span class="float-right"><img src="assets/img/dash/dash-4.png" alt="" width="80"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-12 d-flex">
						<div class="card flex-fill">
							<div class="card-header">
								<div class="row align-items-center">
									<div class="col-auto">
										<div class="page-title">
											Total Income Expance
										</div>
									</div>
								</div>
							</div>
							<div class="card-body d-flex align-items-center justify-content-center overflow-hidden">
								<div id="chart6"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-12 d-flex">
						<div class="card flex-fill">
							<div class="card-header">
								<div class="row align-items-center">
									<div class="col-auto">
										<div class="page-title">
											Income Monthwise
										</div>
									</div>
							</div>
							<div class="card-body">
								<div id="chart5"></div>
							</div>
						</div>
					</div>
							
						</div>
					</div>
				</div>
				
				
				<div class="notification-box">
					<div class="msg-sidebar notifications msg-noti">
						<div class="topnav-dropdown-header">
							<span>Messages</span>
						</div>
						<div class="drop-scroll msg-list-scroll">
							<ul class="list-box">
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">R</span>
											</div>
											<div class="list-body">
												<span class="message-author">Richard Miles </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur
													adipiscing</span>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer">
							<a href="chat.html">See all messages</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="assets/js/jquery-3.6.0.min.js"></script>

	<script src="assets/js/bootstrap.bundle.min.js"></script>


	<script src="assets/js/select2.min.js"></script>
	<script src="assets/js/moment.min.js"></script>

	<script src="assets/js/fullcalendar.min.js"></script>
	<script src="assets/js/jquery.fullcalendar.js"></script>

	<script src="assets/plugins/morris/morris.min.js"></script>
	<script src="assets/plugins/raphael/raphael-min.js"></script>
	<script src="assets/js/apexcharts.js"></script>
	<script src="assets/js/chart-data.js"></script>
	<script src="assets/js/app.js"></script>


	<script>'use strict';

$(document).ready(function() {
    // Example of custom data for New Students and Old Students
    var customSeriesData = [
        {
            name: 'New Students',
            data: [20, 35, 40, 60, 55, 70, 65] // Replace with your data
        },
        {
            name: 'Old Students',
            data: [30, 45, 55, 65, 60, 75, 70] // Replace with your data
        }
    ];

    var customCategories = [
        "2024-01-01T00:00:00.000Z",
        "2024-01-02T00:00:00.000Z",
        "2024-01-03T00:00:00.000Z",
        "2024-01-04T00:00:00.000Z",
        "2024-01-05T00:00:00.000Z",
        "2024-01-06T00:00:00.000Z",
        "2024-01-07T00:00:00.000Z"
    ]; // Replace with your categories

    var options1 = {
        series: customSeriesData,
        chart: {
            height: 350,
            type: 'area'
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        colors: ["#8944D7", "#00B871"],
        xaxis: {
            type: 'datetime',
            categories: customCategories
        },
        legend: {
            position: 'top'
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            }
        }
    };

    var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
    chart1.render();

    var options2 = {
        series: customSeriesData,
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct']
        },
        yaxis: {
            title: {
                text: '$ (thousands)'
            }
        },
        colors: ["#8944D7", "#00B871"],
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return "$ " + val + " thousands";
                }
            }
        }
    };

    var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
    chart2.render();

    var options4 = {
        series: [{
            name: "Value $",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
        }],
        chart: {
            height: 450,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },
        markers: {
            size: 6,
            colors: ["#00B871"],
            strokeColors: "#fff",
            strokeWidth: 2,
            hover: {
                size: 7
            }
        },
        colors: ["#8944D7"],
        grid: {
            row: {
                colors: ['transparent', 'transparent'],
                opacity: 0.5
            }
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
        }
    };

    var chart4 = new ApexCharts(document.querySelector("#chart5"), options4);
    chart4.render();

    Morris.Donut({
        element: 'chart6',
        data: [
            { label: "Total", value: "{{ ($total) }}", labelColor: '#8944D7' },
            { label: "Expenses", value: "{{ ($expense) }}", labelColor: '#2FDF84' },
            { label: "Income", value: "{{ ($income) }}", labelColor: '#00B871' },
            
        ],
        colors: ['#8944D7', '#2FDF84', '#00B871', '#86B1F2'],
        resize: true,
        redraw: true,
    });
});

		</script>
</body>
</html>