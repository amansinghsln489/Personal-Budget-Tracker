<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Preschool - Bootstrap Admin Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">

    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/plugins/datetimepicker/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="assets/css/select2.min.css">

    <link rel="stylesheet" href="assets/plugins/datetimepicker/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

   
</head>
<body>

<div class="main-wrapper">

    <div class="header-outer">
        <div class="header">
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fas fa-bars" aria-hidden="true"></i></a>
            <a id="toggle_btn" class="float-left" href="javascript:void(0);">
            </a>

            <ul class="nav float-left">
                <li>

                </li>
                <li>
                    <a href="index.html" class="mobile-logo d-md-block d-lg-none d-block"><img src="assets/img/logo1.png" alt="" width="30" height="30"></a>
                </li>
            </ul>

            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="assets/img/sidebar/icon-22.png" alt="">
                    </a>
                    
                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><img src="assets/img/sidebar/icon-23.png" alt=""> </a>
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class=" nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user-06.jpg" width="30" alt="Admin">
                        <span class="status online"></span></span>
                        <span>Admin</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right"> 
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                </div>
            </div>
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
                    <li>
                        <a href="{{route('dashboard')}}"><img src="assets/img/sidebar/icon-1.png" alt="icon"><span>Dashboard</span></a>
                    </li>

                    <li class="submenu">
                        <a href="#"><img src="assets/img/sidebar/icon-10.png" alt="icon"><span> Accounts </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">

                            <li><a class="active" href="{{route('expance.index')}}"><span>Expenses</span></a></li>

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
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <h5 class="text-uppercase mb-0 mt-0 page-title">expenses</h5>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <ul class="breadcrumb float-right p-0 mb-0">
                            <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="index.html">Accounts</a></li>
                            <li class="breadcrumb-item"><span>Expenses</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="content-page">
                <div class="row">
                    <div class="col-sm-8 col-5">
                    </div>
                    <div class="col-sm-4 col-7 text-right add-btn-col">
                        <a href="#" class="btn btn-primary btn-rounded float-right" data-toggle="modal" data-target="#add_expense"><i class="fas fa-plus"></i> Add Expense</a>
                    </div>
            </div>  
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="table-responsive">
            <table class="table custom-table mb-0 datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th class="text-center">Income/Expence</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $expense)
                    <tr>
                        <td>
                            <strong>{{ $expense->description }}</strong>
                        </td>
                        <td>{{ $expense->amount }}</td>
                        <td>{{ $expense->date->format('j F Y') }}</td>
                        <td class="text-center">
                            <a href="#" data-toggle="dropdown" aria-expanded="false">
                                @if($expense->status == 1)
                                    <i class="far fa-dot-circle text-success"></i> Income
                                @else
                                    <i class="far fa-dot-circle text-danger"></i> Expences
                                @endif
                            </a>
                        </td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="" title="Edit" data-toggle="modal" data-target="#edit_expense"  data-id="{{ $expense->id }}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="#" title="Delete" data-toggle="modal" data-target="#delete_expense" data-id="{{ $expense->id }}"><i class="fas fa-trash-alt m-r-5"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="add_expense" class="modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h4 class="modal-title">Add Expense</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('expance.add') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="description">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Amaount</label>
                                <input type="text" class="form-control" name="amaount">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group form-focus">
                                <label>Purchase Date</label>
                                <input class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker" name="date">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Income/Expence </label>
                                <select class="select form-control" name="status">
                                <option value="income_expense" selected>Income/Expense</option>
                                <option value="1">Income</option>
                                <option value="0">Expense</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary btn-lg">Create Expense</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="edit_expense" class="modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h4 class="modal-title">Edit Expense</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('expenses.update')}}">
                    @csrf
                    <div class="row">
                    <input type="hidden" name="expense_id" id="expense_id" >
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control"  name="description">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control"  name="amount">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Date</label>
                                <input class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker" name="date">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label></label>
                                <select class="form-control select" name="status">
                                <option value="" disabled selected>Select</option>
                                <option value="1">Income</option>
                                <option value="0">Expense</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary btn-lg mb-3">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="delete_expense" class="modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-md">
        <form method="POST" action="{{route('expenses.delete')}}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Delete Expense</h4>
            </div>
            <div class="modal-body">
            <input type="hidden" name="expence_delete_id" id="category_id">
                <p>Are you sure want to delete this expense?</p>
                <div class="m-t-20 text-left">
                    <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-danger" id="deleteButton" >Delete</button>
                </div>
            </div>
         </div>
     </form>
    </div>
</div>

<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="assets/js/app.js"></script>
<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
     
        $('.dropdown-item').click(function(event) {
            event.preventDefault(); // Prevent default action (e.g., following the href link)

            var expenseId = $(this).attr("data-id");
            var modal = $(this);



            // AJAX request to fetch expense details using the expenseId
            $.ajax({
                url: '/expenses/edit/' + expenseId,               
                type: 'POST', // Use POST method if appropriate
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token if required by your backend
                    expense_id: expenseId // Send expenseId as data
                },
                success: function(expense) {
                    console.log(expense);
                    let isoDate = expense.date;

                   var date =(isoDate.split("T")[0]); 
                   if(expense.status == 1){
                    $('select[name="status"]').val("Income");
                   }
                   else{
                    $('select[name="status"]').val("Expence");
                    }          
                    $('input[name="expense_id"]').val(expense.id);
                    $('input[name="description"]').val(expense.description);
                    $('input[name="amount"]').val(expense.amount);
                    $('input[name="date"]').val(date); // Assuming 'date' is formatted correctly for the input field
                   
                    
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching expense details:', error);
                    // Handle error case
                }
            });
        });
    });
    </script>
    <script>
    $(document).ready(function() {
          
          $('.dropdown-item').click(function(event) {
              event.preventDefault();
              var expenseId = $(this).attr("data-id");
              $('input[name="expence_delete_id"]').val(expenseId);
              $('#delete_expense').modal('show');
          });

          
         
      });
</script>

   

