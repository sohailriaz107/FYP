<aside class="sidebar shadow-lg" id="sidebar">

    <a href="{{ route('dashboard') }}" class="brand text-white text-decoration-none">
        <i class="bi bi-building"></i>
        <span class="fw-bold fs-5 ms-2">Room PMS</span>
    </a>

    <ul class="nav nav-pills flex-column mt-3">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        <!-- Rooms Management -->
        <li class="nav-item">

            <a class="nav-link d-flex justify-content-between align-items-center
                {{ request()->routeIs('rooms*') ? '' : 'collapsed' }}"
                data-bs-toggle="collapse"
                href="#roomsMenu"
                aria-expanded="{{ request()->routeIs('rooms*') ? 'true' : 'false' }}">

                <span>
                    <i class="bi bi-door-open-fill me-2"></i> Rooms Management
                </span>
                <i class="bi bi-chevron-down"></i>
            </a>

            <div class="collapse ps-4 {{ request()->routeIs('rooms*') ? 'show' : '' }}"
                id="roomsMenu">

                <ul class="nav flex-column mt-2">

                    <!-- Category -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('rooms') ? 'active' : '' }}"
                            href="{{ route('rooms') }}">
                            <i class="bi bi-list-ul me-2"></i> Category
                        </a>
                    </li>

                    <!-- Rooms List -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('rooms.list') ? 'active' : '' }}"
                            href="{{ route('rooms.list') }}">
                            <i class="bi bi-door-closed me-2"></i> Rooms List
                        </a>
                    </li>

                </ul>
            </div>
        </li>

        <!-- Amenities -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('amenties.*') ? 'active' : '' }}"
                href="{{ route('amenties.index') }}">
                <i class="bi bi-calendar-check me-2"></i> Amenities
            </a>
        </li>

        <!-- Bookings -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('Booking.*') ? 'active' : '' }}"
                href="{{ route('Booking.index') }}">
                <i class="bi bi-calendar-check me-2"></i> Bookings
            </a>
        </li>

        <!-- Guest -->
        <li class="nav-item">
            <a class="nav-link"
                href="#">
                <i class="bi bi-calendar-check me-2"></i> Guest
            </a>
        </li>

          <li class="nav-item">
            <a class="nav-link "
               href="#">
                <i class="bi bi-calendar-check me-2"></i> Report
            </a>
        </li>

          <li class="nav-item">
            <a class="nav-link "
               href="#">
                <i class="bi bi-calendar-check me-2"></i> Setting
            </a>
        </li>

    </ul>
</aside>