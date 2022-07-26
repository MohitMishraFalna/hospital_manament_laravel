<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ url(asset('assets/img/favicon.png'))}}" rel="icon">
    <link href="{{ url(asset('assets/img/apple-touch-icon.png'))}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url(asset('assets/vendor/bootstrap/css/bootstrap.min.css'))}}" rel="stylesheet">
    <link href="{{ url(asset('assets/vendor/bootstrap-icons/bootstrap-icons.css'))}}" rel="stylesheet">
    <link href="{{ url(asset('assets/vendor/remixicon/remixicon.css'))}}" rel="stylesheet">
    <link href="{{ url(asset('assets/vendor/boxicons/css/boxicons.min.css'))}}" rel="stylesheet">
    <link href="{{ url(asset('assets/vendor/quill/quill.snow.css'))}}" rel="stylesheet">
    <link href="{{ url(asset('assets/vendor/quill/quill.bubble.css'))}}" rel="stylesheet">
    <link href="{{ url(asset('assets/vendor/simple-datatables/style.css'))}}" rel="stylesheet">
    <link href="{{ url(asset('assets/vendor/plugins/summernote-bs4.css'))}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ url(asset('assets/css/style.css'))}}" rel="stylesheet">

    <!-- My Stylesheet -->
    <link rel="stylesheet" href="{{ url(asset('assets/css/myCSS.css'))}}">
    <!-- =======================================================
    * Template Name: NiceAdmin - v2.1.0
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
  </head>

  <body>
    
    <x-layout.navbar />
    <x-layout.sidebar />

    {{ $main_content }}
    
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
      <div class="copyright">
        &copy; Copyright <strong><span> {{ session()->get('roll')}} Admin</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ url(asset('assets/vendor/bootstrap/js/bootstrap.bundle.js'))}}"></script>
    <script src="{{ url(asset('assets/vendor/php-email-form/validate.js'))}}"></script>
    <script src="{{ url(asset('assets/vendor/quill/quill.min.js'))}}"></script>
    <script src="{{ url(asset('assets/vendor/tinymce/tinymce.min.js'))}}"></script>
    <script src="{{ url(asset('assets/vendor/simple-datatables/simple-datatables.js'))}}"></script>
    <script src="{{ url(asset('assets/vendor/chart.js/chart.min.js'))}}"></script>
    <script src="{{ url(asset('assets/vendor/apexcharts/apexcharts.min.js'))}}"></script>
    <script src="{{ url(asset('assets/vendor/echarts/echarts.min.js'))}}"></script>
    <script src="{{ url(asset('assets/vendor/plugins/summernote-bs4.js'))}}"></script>

    <!-- Template Main JS File -->
    <script src="{{ url(asset('assets/js/main.js'))}}"></script>

    <!-- My JavaScript Files. -->
    <script src="{{ url(asset('assets/js/myJs.js'))}}"></script>
    <script src="{{ url(asset('assets/js/validation.js'))}}"></script>

  </body>

</html>