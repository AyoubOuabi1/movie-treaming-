<nav  class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion sidebar-bg " >
    <div class="container-fluid d-flex flex-column p-0"><a
            class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
             <div class="sidebar-brand-text mx-3"><span>Drama House</span></div>
        </a>
        <hr class="sidebar-divider my-0">
        <ul class="navbar-nav text-light" id="accordionSidebar">
            <li class="nav-item"><a class="nav-link active" href="{{route('dashboard')}}"><i
                        class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('getMovies')}}"><i
                        class="bi bi-film"></i><span>Movies</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('getActors')}}"><i
                        class="bi bi-person-circle"></i><span>Actors</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('loadCategories')}}"><i
                        class="bi bi-tags"></i><span>Categories</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('getUsers')}}"><i class="fas fa-user-circle"></i><span>Users</span></a>
            </li>
        </ul>
        <div class="text-center d-none d-md-inline">
            <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
        </div>
    </div>
</nav>
