
<!--
|--------------------------------------------------------------------------
| Interviee Dashboard
|--------------------------------------------------------------------------
-->
<!-- FullCalendar CSS -->
@foreach($interviewees as $interviewee)
@if($interviewee->user_id == $user->user_id)
    <div class="content-page">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="aboutprofile-sidebar">
                    <div class="row">
                        <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                            <div class="aboutprofile">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                          
                                                <div class="aboutprofile-pic">
                                                    <!-- <img class="card-img-top" src="assets/img/user.jpg" alt="Card image"> -->
                                                    @if($interviewee->user_image)
                                                        <span class="aboutprofile-pic">
                                                            <img class="img-fluid" src="{{ asset('storage/' . $interviewee->user_image) }}" alt="">
                                                        </span>
                                                    @else
                                                        <span class="avatar">{{ strtoupper(substr($interviewee->firstname, 0, 1)) }}{{ strtoupper(substr($interviewee->lastname, 0, 1)) }}</span>
                                                    @endif
                                                </div>
                                                <div class="aboutprofile-name">
                                                    <h5 class="text-center mt-2">Michael V. Buttars</h5>
                                                    <p class="text-center">Maths Teacher</p>
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <b>Followers</b>
                                                        <a href="#" class="float-right">1000</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Following</b>
                                                        <a href="#" class="float-right">700</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Friends</b>
                                                        <a href="#" class="float-right">5000</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12"> <!-- New column for the additional card -->
                            <div class="aboutprofile">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="aboutprofile-pic">
                                                    <img class="card-img-top" src="assets/img/user2.jpg" alt="Card image">
                                                </div>
                                                <div class="aboutprofile-name">
                                                    <h5 class="text-center mt-2">Jane D. Doe</h5>
                                                    <p class="text-center">Science Teacher</p>
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <b>Followers</b>
                                                        <a href="#" class="float-right">1200</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Following</b>
                                                        <a href="#" class="float-right">800</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Friends</b>
                                                        <a href="#" class="float-right">4500</a>
                                                    </li>
                                                </ul>
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
    @endif
@endforeach






