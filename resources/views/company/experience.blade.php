@extends('layouts.app')

@section('content')
@section('title', 'technology')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">experience</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="add-card.php">experience</a></li>
                        <li class="breadcrumb-item"><span> Add Experience</span></li>
                    </ul>
                </div>
            </div>
            <!-- <div class="col-sm-12 col-12 text-left add-btn-col">
                <a href="" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> Add New Record </a>
            </div> -->
        </div>
        
        <script src="assets/js/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.js"></script>
       

        <!-- Display Toastr messages -->
        <script>
            $(document).ready(function() {
                @if(session('error'))
                    toastr.error("{{ session('errorMessage') }}", "", { 
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
                                            Add Experience 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(isset($editExperience))
                                <!-- Form for editing technology -->
                                <form action="{{ route('add.experience.submit') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" class="form-control" value="{{ $editExperience->experience_id }}" name="experience_id">
                                    <div class="form-group">
                                        <label>Experience</label>
                                        <input type="text" class="form-control" value="{{ $editExperience->experience }}" name="experience_name" id="experience_name">
                                        <div id="technology_name_error" class="error" style="color: red; font-weight: bold;"></div>
                                    </div>

                                   
                                
                                    <div class="form-group text-center custom-mt-form-group">
                                        <button class="btn btn-primary mr-2" type="submit" name="submit">Update Experience</button>
                                        <button class="btn btn-secondary" type="reset">Reset</button>
                                    </div>
                                </form>
                            @else
                           
                  
                                <!-- Form for adding technology -->
                                <form action="{{ route('add.experience.submit') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Experience</label>
                                        <input type="text" class="form-control" placeholder="Enter the year of Experience " name="experience_name" id="technology_name">
                                        <div id="technology_name_error" class="error" style="color: red; font-weight: bold;"></div>
                                    </div>
                                
                                    <div class="form-group text-center custom-mt-form-group">
                                        <button class="btn btn-primary mr-2" type="submit" name="submit">Add Experience</button>
                                        <button class="btn btn-secondary" type="reset">Reset</button>
                                    </div>
                                </form>
                          @endif

                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="page-title">
                                Experience Lists
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="grid2" class="grid">
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Experience Id</th>
                                        <th>Experience</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($experiences as $experience)
                                        <tr class="draggable-row">
                                            <td>{{ $experience->experience_id }}</td>
                                            <td>{{ $experience->experience }}</td>
                                            
                                            <td class="text-right">
                                                <a href="{{ route('edit.experience', $experience->experience_id) }}" class="btn btn-primary btn-sm mb-1">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <a href="{{ route('delete.experience', $experience->experience_id) }}" class="btn btn-danger btn-sm mb-1">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
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
        </div>
        @include('section/notification') 
    </div>
</div>
<script>
        dragula([document.getElementById('grid2').getElementsByTagName('tbody')[0]]);
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

