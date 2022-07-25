 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="{{route('dashboard')}}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    
    <!-- End Dashboard Nav -->
    <!-- Start Components Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-grid"></i><span>Departments</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{route('departmentNew')}}">
            <i class="bi bi-pencil-fill" style="font-size:20px;"></i><span>New</span>
          </a>
        </li>
        <li>
          <a href="{{route('list')}}">
            <i class="bi bi-list-ol" style="font-size:20px;"></i><span>List</span>
          </a>
        </li>
        
      </ul>
    </li>
    <!-- End Components Nav -->

    <!-- Start Staff Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#doctors-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-grid"></i><span>Staff</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="doctors-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{route('staffNew')}}">
            <i class="bi bi-pencil-fill" style="font-size:20px;"></i><span>New</span>
          </a>
        </li>
        <li>
          <a href="{{route('staffList')}}">
            <i class="bi bi-list-ol" style="font-size:20px;"></i><span>List</span>
          </a>
        </li>
        <li>
          <a href="{{route('docList')}}">
            <i class="bi bi-list-ol" style="font-size:20px;"></i><span>All Doctor</span>
          </a>
        </li>
        
      </ul>
    </li>
    <!-- End Doctors Nav -->

    <!-- Start Components Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#doctor" data-bs-toggle="collapse" href="#">
        <i class="bi bi-grid"></i><span>Doctors</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="doctor" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{route('doctorNew')}}">
            <i class="bi bi-pencil-fill" style="font-size:20px;"></i><span>New</span>
          </a>
        </li>
        <li>
          <a href="{{route('doctorList')}}">
            <i class="bi bi-list-ol" style="font-size:20px;"></i><span>List</span>
          </a>
        </li>
        
      </ul>
    </li>
    <!-- End Components Nav -->

    <!-- Start Components Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#post" data-bs-toggle="collapse" href="#">
        <i class="bi bi-grid"></i><span>Articles</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="post" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{route('postNew')}}">
            <i class="bi bi-pencil-fill" style="font-size:20px;"></i><span>New</span>
          </a>
        </li>
        <li>
          <a href="{{route('postList')}}">
            <i class="bi bi-list-ol" style="font-size:20px;"></i><span>List</span>
          </a>
        </li>
        
      </ul>
    </li>
    <!-- End Components Nav -->

    <!-- Start Components Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#test" data-bs-toggle="collapse" href="#">
        <i class="bi bi-grid"></i><span>Test Type</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="test" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{route('testNew')}}">
            <i class="bi bi-pencil-fill" style="font-size:20px;"></i><span>New</span>
          </a>
        </li>
        <li>
          <a href="{{route('testList')}}">
            <i class="bi bi-list-ol" style="font-size:20px;"></i><span>List</span>
          </a>
        </li>
        
      </ul>
    </li>
    <!-- End Components Nav -->

  </ul>

</aside><!-- End Sidebar-->