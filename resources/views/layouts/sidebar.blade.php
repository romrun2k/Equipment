<div
    class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 position-sticky top-0">
    <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-5 d-none d-sm-inline">Menu</span>
    </a>
    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

        <li class="nav-item">
            <a href="/home" class="nav-link align-middle px-0">
                <i class="bi bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
            </a>
        </li>

        @if (Auth()->user()->role != 'admin')
            <li>
                <a href="{{ url('orderList') }}" class="nav-link px-0 align-middle">
                    <i class="bi bi-card-list"></i> <span class="ms-1 d-none d-sm-inline">Order List</span>
                </a>
            </li>
        @endif

        @if (Auth()->user()->role == 'admin')
            <li>
                <a href="{{ url('employee') }}" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Employee</span>
                </a>
            </li>

            <li>
                <a href="{{ url('master_quipment') }}" class="nav-link px-0 align-middle">
                    <i class="bi bi-display"></i> <span class="ms-1 d-none d-sm-inline">Equipment</span>
                </a>
            </li>
        @endif
    </ul>
    <hr>

    <div class="dropdown pb-4">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            id="dropdownUser1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
            <span class="d-none d-sm-inline mx-1">{{ Auth()->user()->name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <a class="dropdown-item" href="{{ route('logout') }}">Log out</a>
        </div>
    </div>
</div>
