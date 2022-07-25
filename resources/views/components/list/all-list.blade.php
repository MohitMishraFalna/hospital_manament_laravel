<div>    
    <!-- Start #main -->
    <main id="main" class="main">
        <!-- Start Page Title -->
        <div class="pagetitle">
            <h1>List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <!-- <li class="breadcrumb-item">Tables</li> -->
                    <li class="breadcrumb-item active">{{$urls["pageTitle"]}}</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <div  style="float: left; width: 10%;"><a href="{{route($urls['pageRoute'])}}" class="myBtn">New</a></div>
                                <div style="float: left; width: 78%;">
                                    <input type="text" class="search-box" name="searchFromTable" placeholder="Search" title="Enter search keyword">
                                  
                                </div>
                                <div style="float: left; width: 10%; margin-left: 10%;">
                                    <form action="{{route($urls['paginate'])}}" name="paginateForm" method="get">
                                        <select class="form-control perPage" style="width:auto" aria-label="Default select example" id="perPage" name="perPage">
                                            <option >Per Page</option>
                                            <option value="1">Five</option>
                                            <option value="2">Ten</option>
                                            <option value="3">Twenty</option>
                                            <option value="5">Fifty</option>
                                        </select>
                                    </form>
                                </div>                                  
                            </div>

                            @if(session()->has('status'))
                                <div class="alert alert-primary alert-dismissible fade show " role="alert">             
                                    {{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="col-md-12" style="overflow:auto;">
                            <!-- Table with stripped rows -->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        @for($col=0; $col < count($columns); $col++)
                                            <th scope="col">{{ ucwords(str_replace('_', ' ', $columns[$col])) }}</th>
                                        @endfor
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="tableBody">
                                    @foreach ($values as $key => $value)
                                        <tr>                     
                                            @for($val = 0; $val < count($value); $val++)
                                                @if($values[$key][$val] == "activate")
                                                    <td><a href="{{route($urls['sts'], [$values[$key][$val], $values[$key][0]])}}"><i class="bi bi-toggle2-on" id="toggle2-on" style="color:#012970; font-size:23px; cursor:pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate"></i></a></td>
                                                @elseif($values[$key][$val] == "deactivate")
                                                    <td><a href="{{route($urls['sts'], [$values[$key][$val], $values[$key][0]])}}"><i class="bi bi-toggle2-off" id="toggle2-off" style="color:#012970; font-size:23px; cursor:pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="Activate"></i></a></td>
                                                @else
                                                    <td>{{ucwords($values[$key][$val])}}</td>
                                                @endif
                                            @endfor
                                            <td>
                                                <a href="{{route($urls['edit'], $values[$key][0])}}"><i class="bi bi-pencil-square" style="color:#012970;" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>
                                                <a href="{{route($urls['delete'], $values[$key][0])}}"><i class="bi bi-trash" style="color:#012970;" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table></div>
                            <!-- End Table with stripped rows -->
                            <!-- Disabled and active states -->
                            <nav aria-label="...">
                                <ul class="pagination">
                                    {{ $urls['pageLink'] }}

                                    <!-- If we want to use links() function without any type of configuration
                                in serviceProvider of laravel app so we can use $var_name->links("pagination::bootstrap-4) -->

                                    <!-- <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li> -->
                                </ul>
                            </nav><!-- End Disabled and active states -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            // Per page record.
            let perPage = document.getElementsByName("perPage")[0];
            let pageNumber;
            perPage.onchange = function() {
                pageNumber = perPage.value;
                document.getElementsByName("paginateForm")[0].submit();
            }

            // Search data from table.
            let searchFunction = document.getElementsByName("searchFromTable")[0];
            searchFunction.addEventListener("keyup", function(){
                if(searchFunction.value != ""){
                    let data = {"searchText":searchFunction.value}
                    let stringifyData = JSON.stringify(data);

                    // this urls['srcName] coming from the controller.
                    let url = "{{route($urls['srcName'])}}?data="+stringifyData;
                    let xhr = new XMLHttpRequest();
                    xhr.open("GET", url, false);
                    xhr.onreadystatechange = function(){
                        if(xhr.readyState == 4 && xhr.status == 200){
                            let response = JSON.parse(xhr.responseText);
                            if(response.status == 'false'){
                                return;
                            }

                            document.getElementsByClassName("tableBody")[0].style.display = "none";
                            document.getElementsByClassName("table")[0].innerHTML = response.records;

                        }
                    }
                    xhr.send();
                }
            });
        </script>
    </main>
    <!-- End #main -->

</div>