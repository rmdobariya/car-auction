<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('admin.dashboard')}}">Home</a>
                </li>

                <div class="dropdown">
                    <a class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item" href="{{route('admin.my-profile')}}">My Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('admin.change-password')}}">Change Password</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('admin.logout')}}">Logout</a>
                        </li>
                    </ul>
                </div>

            </ul>
        </div>
    </div>
</nav>
