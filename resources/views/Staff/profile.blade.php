<x-layout.header>
    <x-slot name="title">User Profile</x-slot>
    <x-slot name="main_content">
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>User Profile</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <!-- <li class="breadcrumb-item">Forms</li> -->
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            @if(session()->has("status"))
                <div class="alert alert-primary alert-dismissible fade show " role="alert">
                    {{ session("status") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <section class="section profile">
                <div class="row">
                    <div class="col-xl-4">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                <img src="{{url('assets/AllFiles', $datas->stf_img)}}" alt="Profile" class="rounded-circle">
                                <h2>Kevin Anderson</h2>
                                <h3>{{$datas->dept_id}}</h3>
                                <div class="social-links mt-2">
                                    <a href="{{$datas->stf_twitter}}" class="twitter"><i class="bi bi-twitter"></i></a>
                                    <a href="{{$datas->stf_facebook}}" class="facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="{{$datas->stf_instagram}}" class="instagram"><i class="bi bi-instagram"></i></a>
                                    <a href="{{$datas->stf_linkedin}}" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-8">

                        <div class="card">
                            <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">About</h5>
                                    <p class="small fst-italic">{{$datas->stf_about}}</p>

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">{{$datas->stf_name}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">dob</div>
                                        <div class="col-lg-9 col-md-8">{{$datas->dept_id}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Country</div>
                                        <div class="col-lg-9 col-md-8">{{$datas->contry}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8">{{$datas->stf_city}}, {{$datas->stf_block}}, {{$datas->stf_district}}, {{$datas->stf_region}}, {{$datas->stf_state}}, {{$datas->stf_picode}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">{{$datas->stf_phone}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{$datas->stf_email}}</div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form method="POST" action="{{route('updateProfile', $datas->id)}}" enctype="multipart/form-data">
                                        @csrf
                                        <h5 class="card-title">Personal Details</h5>
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="{{url('assets/AllFiles', $datas->stf_img)}}" alt="Profile">
                                                    <input type="hidden" name="hid_image" value="{{$datas->stf_img}}">
                                                <div class="pt-2">
                                                    <input type="file" name="image" class="btn btn-primary bi bi-upload btn-sm" title="Upload new profile image">
                                                    <!-- <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="fullName" value="{{$datas->stf_name}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                        <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="about" class="form-control" id="about" style="height: 100px" value="{{$datas->stf_about}}">{{$datas->stf_about}}</textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="dob" class="col-md-4 col-lg-3 col-form-label">DOB</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="hid_age" type="hidden"value="{{$datas->stf_age}}">
                                                <input name="age" type="date" class="form-control" id="dob">
                                                <label for="dob" class="col-md-8 col-lg-9 col-form-label">{{$datas->stf_age}}</label>
                                            </div>
                                        </div>                                        

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="Phone" value="{{$datas->stf_phone}}">
                                            </div>
                                        </div>

                                        <h6 class="card-title">Address Block</h6>
                                        <div class="row mb-3">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Home</label>
                                            <div class="col-md-8 col-lg-3">
                                                <input name="city" type="text" class="form-control" id="city" value="{{$datas->stf_city}}">
                                            </div>
                                            <div class="col-md-8 col-lg-3">
                                                <input name="block" type="text" class="form-control" id="block" value="{{$datas->stf_block}}">
                                            </div>
                                            <div class="col-md-8 col-lg-3">
                                                <input name="district" type="text" class="form-control" id="district" value="{{$datas->stf_district}}">
                                            </div>
                                            <div class="col-md-8 col-lg-3">
                                                <input name="region" type="text" class="form-control" id="region" value="{{$datas->stf_region}}">
                                            </div>
                                            <div class="col-md-8 col-lg-3">
                                                <input name="state" type="text" class="form-control" id="state" value="{{$datas->stf_state}}">
                                            </div>
                                            <div class="col-md-8 col-lg-3">
                                                <input name="contry" type="text" class="form-control" id="contry" value="{{$datas->stf_contry}}">
                                            </div>
                                            <div class="col-md-8 col-lg-3">
                                                <input name="zip" type="text" class="form-control" id="zip" value="{{$datas->stf_zip}}">
                                            </div>
                                        </div>

                                        <h6 class="card-title">Social Media Block</h6>
                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email" value="{{$datas->stf_email}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/{{$datas->stf_twitter}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/{{$datas->stf_facebook}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/{{$datas->stf_instagram}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/{{$datas->stf_linkedin}}">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <div class="alert1 alert-primary alert-dismissible fade show " role="alert">
                                        
                                    </div>
                                    <!-- Change Password Form -->
                                    <form method="post" action="{{route('changePassword', $datas->id)}}">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control" id="currentPassword" value="{{$datas->stf_pass}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newpassword" type="text" class="form-control" id="newPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary" name="btnPass">Change Password</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                            </div>
                        </div>

                    </div>
                </div>
            </section>            
        </main>
        <script>
            // match new password to re-password.
                document.getElementsByName("btnPass")[0].onclick = function (e) {
                    if(document.getElementsByName("newpassword")[0].value != document.getElementsByName("renewpassword")[0].value){
                        e.preventDefault();
                        document.getElementsByClassName("alert1")[0].innerHTML = "New and Renewpassword doesn't match.";
                    }
                }
        </script>
        <!-- End #main -->
    </x-slot>
</x-layout.header>