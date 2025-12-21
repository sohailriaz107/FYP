<aside class="sidebar shadow-lg" id="sidebar">
    <a href="#" class="brand text-white text-decoration-none">
        <i class="bi bi-building"></i>
        <span class="fw-bold fs-5 ms-2">Room PMS</span>
    </a>

    <ul class="nav nav-pills flex-column mt-3">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        <!-- Rooms Management -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center"
                data-bs-toggle="collapse"
                href="#roomsMenu"
                role="button"
                aria-expanded="false"
                aria-controls="roomsMenu">

                <span>
                    <i class="bi bi-door-open-fill me-2"></i> Rooms Management
                </span>

                <i class="bi bi-chevron-down"></i>
            </a>

            <!-- Collapse Menu -->
            <div class="collapse ps-4" id="roomsMenu">
                <ul class="nav flex-column mt-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rooms') }}">
                            <i class="bi bi-list-ul me-2"></i> Category
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('rooms.list')}}">
                            <i class="bi bi-door-closed me-2"></i> Rooms List
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- amenties -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('amenties.index')}}">
                <i class="bi bi-calendar-check me-2"></i> Amenities
            </a>
        </li>
        <!-- Bookings -->
        <li class="nav-item">
            <a class="nav-link" href="#bookings">
                <i class="bi bi-calendar-check me-2"></i> Bookings
            </a>
        </li>

        <!-- Guests -->
        <li class="nav-item">
            <a class="nav-link" href="#guests">
                <i class="bi bi-people-fill me-2"></i> Guests
            </a>
        </li>

        <!-- Reports -->
        <li class="nav-item">
            <a class="nav-link" href="#reports">
                <i class="bi bi-bar-chart-fill me-2"></i> Reports
            </a>
        </li>

        <!-- Settings -->
        <li class="nav-item">
            <a class="nav-link" href="#settings">
                <i class="bi bi-gear-fill me-2"></i> Settings
            </a>
        </li>

    </ul>
</aside>