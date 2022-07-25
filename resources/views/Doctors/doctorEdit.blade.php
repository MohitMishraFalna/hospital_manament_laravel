<x-layout.header>
    <x-slot name="title">New Doctor</x-slot>
    <x-slot name="main_content">
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Add New Doctor</h1>
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
                                <a href="{{route('doctorList')}}" class="myBtn">List</a>
                            </p>

                            <!-- Vertical Form -->
                            <form class="row g-3" method="POST" action="{{route('doctorUpdate', $datas->id)}}">
                                @csrf
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label" style="margin-top:40px;">Doctor Name</label>
                                    <input type="text" class="form-control name" id="name" name="name" value="{{$datas->doc_name}}">
                                    <i class="error">@error("name"){{$message}} @enderror</i>
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