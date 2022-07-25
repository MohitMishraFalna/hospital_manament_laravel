<x-layout.header>
    <x-slot name="title">Doctor Post</x-slot>
    <x-slot name="main_content">
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Add New Post</h1>
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
                                <a href="{{route('postList')}}" class="myBtn">List</a>
                            </p>

                            <!-- Vertical Form -->
                            <form class="row g-3" method="POST" name="form_validation" action="{{route('postUpdate', $datas->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label" style="margin-top:40px;">Post Title</label>
                                    <input type="text" class="form-control name" id="name" name="post_title" value="{{$datas->post_title}}">
                                </div>
                                <div class="col-6">
                                    <label for="inputNanme4" class="form-label" style="margin-top:40px;">Post Image</label>
                                    <input type="file" class="form-control post_type" id="post_type" name="post_image">
                                </div>
                                <div class="col-6">
                                    <img src="{{url('assets/AllFiles', $datas->post_img)}}" alt="" style="height: 120px; margin-left: 120px;">    
                                    <input type="hidden" name="hid_image" value="{{$datas->post_img}}">
                                </div>
                                <label for="inputNanme4" class="form-label" style="margin-top:40px;">Write something here for today.</label>
                                <div class="col-lg-12">
                                    <!-- TinyMCE Editor -->
                                    <textarea class="tinymce-editor" name="new_post">
                                        {{$datas->new_post}}
                                    </textarea><!-- End TinyMCE Editor -->
                                </div>
                                <!-- <div class="col-md-3">
                                    <input type="text" class="form-control range" id="range" name="end_range" placeholder="end range">
                                    <i class="error">@error("range"){{$message}} @enderror</i>
                                </div> -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary submit">Submit</button>
                                    <button type="reset" class="btn btn-secondary reset">Reset</button>
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