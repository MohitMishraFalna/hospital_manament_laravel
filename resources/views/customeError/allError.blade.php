<x-layout.header>
  <x-slot name="title"> Error </x-slot>
  <x-slot name="main_content">
    <!-- Main content -->
    <main style="padding-top:50px;">
      <div class="container">
        <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
          <img src="assets/img/errorPage.jpg" class="img-fluid" alt="Page Not Found">
          <h1 class="py-5">Oops!</h1>
          <h2 class="py-2" style="font-size:200%">
            @if(session()->has("status"))
              {{ session("status") }}
            @endif
          </h2>
          <a class="btn" href="{{route(session('url'))}}">Back to {{ session('url')}}</a>
        </section>

      </div>
    </main><!-- End #main -->
    <script>
  setTimeout(() => {
        window.location.href = "{{route(session('url'))}}";
    }, 3000);
  </script>
  </x-slot>

</x-layout.header>