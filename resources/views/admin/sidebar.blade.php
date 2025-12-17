<aside class="sidebar shadow-lg" id="sidebar">
    <a href="#" class="brand text-white text-decoration-none">
        <i class="bi bi-building"></i> <span class="fw-bold fs-5">Room PMS</span>
    </a>

    <ul class="nav nav-pills flex-column">

        <li class="nav-item">
            <a class="nav-link active" href="{{route('dashboard')}}">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
        </li>

        <ul class="nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="roomsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-door-open-fill me-2"></i> Rooms Management
                </a>
                <ul class="dropdown-menu" aria-labelledby="roomsDropdown">
                    <li>
                        <a class="dropdown-item" href="">
                            <i class="bi bi-door-open-fill me-2"></i> Category
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="">
                            <i class="bi bi-door-open-fill me-2"></i> Rooms List
                        </a>
                    </li>
                </ul>
            </li>
        </ul>


        <li class="nav-item">
            <a class="nav-link" href="#bookings">
                <i class="bi bi-calendar-check me-2"></i>Bookings
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#guests">
                <i class="bi bi-people-fill me-2"></i>Guests
            </a>
        </li>

        <li class="nav-item mt-4">
            <a class="nav-link" href="#reports">
                <i class="bi bi-bar-chart-fill me-2"></i>Reports
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#settings">
                <i class="bi bi-gear-fill me-2"></i>Settings
            </a>
        </li>

    </ul>
</aside>