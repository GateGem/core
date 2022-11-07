<div class="header navbar">
    <div class="header-container">
        <ul class="nav-left">
            <li><a onclick="switchSidebar()"> <i class="bi bi-justify fs-4"></i></a></li>
        </ul>
        <ul class="nav-right">
            <li class="">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Dropdown button
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </div>
        </li>
            <li>{{auth()->user()->name}}</li>
        </ul>
    </div>
</div>
