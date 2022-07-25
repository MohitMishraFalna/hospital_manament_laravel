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
                <div class="alert-primary alert-dismissible fade show " role="alert">
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
                            <form class="row g-3" method="POST" name="form_validation" action="{{route('postCreate')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-6">
                                    <label for="inputNanme4" class="form-label" style="margin-top:40px;">Post Name</label>
                                    <input type="text" class="form-control name" id="name" name="post_title">
                                </div>
                                <div class="col-6">
                                    <label for="inputNanme4" class="form-label" style="margin-top:40px;">Image upload</label>
                                    <input type="file" class="form-control post_image" id="post_image" name="post_image">
                                </div>
                                <label for="inputNanme4" class="form-label" style="margin-top:40px;">Write something here for today.</label>
                                <div class="col-lg-12">
                                    <!-- TinyMCE Editor -->
                                    <textarea class="tinymce-editor" name="new_post">
                                        
                                    </textarea><!-- End TinyMCE Editor -->
                                </div>
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