@php
    $user=\App\Http\Controllers\UserController::userInfo();
@endphp
<nav class="navbar bg-transparent navbar-expand  shadow mb-4 topbar static-top ">
    <div class="container-fluid d-flex justify-content-around">
        <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
        <ul class="navbar-nav  bg-transparent flex-nowrap ms-auto">

            <div class="d-none d-sm-block topbar-divider"></div>
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">{{$user->name}}</span><img class="border rounded-circle img-profile" src="{{$user->image}}"></a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                        <a class="dropdown-item" href="{{route('user-profile')}}">
                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile
                        </a>
                         <div class="dropdown-divider"></div><a class="dropdown-item" href="{{route('logout')}}"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
