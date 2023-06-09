<nav  class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion sidebar-bg " >
    <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-start align-items-center sidebar-brand " href="#">
            <div class="sidebar-brand-icon"><img src="{{URL::asset('icon.png')}}" height="30px" width="60px" class="" alt="ICON"></div>
             <div class="sidebar-brand-text mx-1"><span>Drama House</span></div>
        </a>
        <hr class="sidebar-divider my-0">
        <ul class="navbar-nav text-light" id="accordionSidebar">
            <li class="nav-item"><a class="nav-link" href="{{route('home-page')}}">
                    <i class="bi bi-house"></i><span>Home</span></a></li>
            <li class="nav-item"><a class="nav-link active" href="{{route('dashboard')}}"><i
                        class="bi bi-speedometer2"></i><span>Dashboard</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('getMovies')}}"><i
                        class="bi bi-file-play"></i><span>Movies</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('getActors')}}"><i
                        class="bi bi-person-circle"></i><span>Actors</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('loadCategories')}}"><i
                        class="bi bi-tags"></i><span>Categories</span></a></li>
            @if(\App\Http\Middleware\JwtMiddleware::checkUser()==3)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('getUsers')}}">
                        <i class="fas fa-user-circle"></i><span>Users</span>
                    </a>
                </li>
            @endif
        </ul>
        <div class="text-center d-none d-md-inline">
            <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
        </div>
    </div>
</nav>
