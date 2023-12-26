<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        @if (auth()->user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('location.index') }}">
                    <span class="menu-title">Location</span>
                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('trip.index') }}">
                    <span class="menu-title">Trip</span>
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ route('booking.index') }}">
                <span class="menu-title">Book a trip</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('allBookings') }}">
                <span class="menu-title">Purchase Ticket List</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
