<x-layout.header>
    <x-slot name="title">New Employee</x-slot>
    <x-slot name="main_content">
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Add New Employee</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <!-- <li class="breadcrumb-item">Forms</li> -->
                        <li class="breadcrumb-item active">New</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            @if(session()->has("status"))
                <div class="alert alert-primary alert-dismissible fade show " role="alert">
                    {{ session("status") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">
                                    <a href="{{route('staffList')}}" class="myBtn">List</a>
                                </p>

                                <form class="row g-3" method="POST" action="{{route('staffUpdate', $datas->id)}}" enctype="multipart/form-data" name="form_validation1">
                                    @csrf
                                    <label class="col-form-label" style="color:#012970; margin-top:40px">Personal Details</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control name" name="name" value="{{$datas->stf_name}}" placeholder="Name">
                                        <i class="error">@error("name") {{$message}} @enderror</i>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control email" name="email" value="{{$datas->stf_email}}" placeholder="Email">
                                        <i class="error">@error("email"){{$message}} @enderror</i>
                                    </div>
                                    
                                    <div class="col-6">
                                        <input type="text" class="form-control phone" name="phone" value="{{$datas->stf_phone}}" placeholder="Phone Number">
                                        <i class="error">@error("phone"){{$message}} @enderror</i>
                                    </div>
                                    
                                    <div class="col-3">
                                        <input type="file" class="form-control image" name="image" placeholder="Select Image">
                                        <input type="hidden" class="form-control image" name="hid_image" value="{{$datas->stf_img}}" placeholder="Select Image">
                                        <i class="error">@error("image"){{$message}} @enderror</i>
                                    </div>
                                    
                                    <div class="col-3">
                                        <img src="{{url('assets/AllFiles', $datas->stf_img)}}" alt="" srcset="" height="40px" width="40px">
                                    </div>

                                    <div class="col-md-6">
                                        <input type="date" class="form-control age" name="age" placeholder="Password">
                                        <input type="hidden" class="form-control age" name="hid_age" value="{{$datas->stf_age}}" placeholder="Password">
                                        <lable>{{$datas->stf_age}}</lable>
                                        <i class="error">@error("age"){{$message}} @enderror</i>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        
                                        <select id="inputState" class="form-select department" name="department">
                                                @foreach($departments as $department)
                                                    @if($datas->dept_id == $department->id)
                                                        <option selected="" value="{{$department->id}}">{{ucwords($department->dept_name)}}</option>
                                                    @else
                                                        <option value="{{$department->id}}">{{ucwords($department->dept_name)}}</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                    </div>
                                    
                                    <label class="col-form-label" style="color:#012970;">Address Details</label>
                                    <div class="apiError" style="display:none">

                                    </div>
                                    
                                    <label for="">Please fill only one zip code/postal name.</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control zip" name="zip" value="{{$datas->stf_zip}}" placeholder="Zip code.">
                                        <i class="error">@error("zip"){{$message}} @enderror</i>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <input type="text" class="form-control post_name" name="post_name" value="{{$datas->stf_post_name}}" placeholder="Postal name.">
                                        <i class="error">@error("post_name"){{$message}} @enderror</i>
                                    </div>
                                    
                                    <div class="col-md-4" id="city">
                                        <select id="inputCity" class="form-select city" name="city" value="{{$datas->stf_city}}">
                                            <option selected="" value="{{$datas->stf_city}}">{{$datas->stf_city}}</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <input type="text" class="form-control block" name="block" value="{{$datas->stf_block}}" placeholder="Block">
                                        <i class="error">@error("block"){{$message}} @enderror</i>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <input type="text" class="form-control district" name="district" value="{{$datas->stf_district}}" placeholder="District">
                                        <i class="error">@error("district"){{$message}} @enderror</i>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <input type="text" class="form-control region" name="region" value="{{$datas->stf_region}}" placeholder="Region">
                                        <i class="error">@error("region"){{$message}} @enderror</i>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <input type="text" class="form-control state" name="state" value="{{$datas->stf_state}}" placeholder="State">
                                        <i class="error">@error("state"){{$message}} @enderror</i>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <input type="text" class="form-control contry" name="contry" value="{{$datas->stf_contry}}" placeholder="Contry">
                                        <i class="error">@error("contry"){{$message}} @enderror</i>
                                    </div>
                                    
                                    <h6 class="card-title">Social Media Block</h6>
                                        <div class="col-md-3">
                                            <input name="twitter" type="text" class="form-control" id="Twitter" value="{{$datas->stf_twitter}}" placeholder="Enter your twitter account">
                                        </div>

                                        <div class="col-md-3">
                                            <input name="facebook" type="text" class="form-control" id="Facebook" value="{{$datas->stf_facebook}}" placeholder="Enter your facebook account">
                                        </div>

                                        <div class="col-md-3">
                                            <input name="instagram" type="text" class="form-control" id="Instagram" value="{{$datas->stf_instagram}}" placeholder="Enter your instagram account">
                                        </div>

                                        <div class="col-md-3">
                                            <input name="linkedin" type="text" class="form-control" id="Linkedin" value="{{$datas->stf_linkedin}}" placeholder="Enter your linkedin account">
                                        </div>

                                        <div class="col-md-12">
                                            <label for="about" class="col-form-label" style="color:#012970;">Write here Something about you...</label>
                                            <textarea name="about" class="form-control about" id="about" style="height: 50px;">{{$datas->stf_about}}</textarea>
                                        </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary submit">Submit</button>
                                        <!-- <button type="reset" class="btn btn-secondary reset">Reset</button> -->
                                    </div>

                                    <!-- This div cover the body when spinner display on. -->
                                    <div class="bodyCover" style="display:none;">
                                        <div class="spinner-border loader" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </form><!-- Vertical Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- End #main -->
    </x-slot>
</x-layout.header>