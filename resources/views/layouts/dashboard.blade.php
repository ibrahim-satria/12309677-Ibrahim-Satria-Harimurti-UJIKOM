<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Inventory Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        #sidebar {
            width: 250px;
            background-color: #274092;
            /* The exact dark blue from the screenshot */
            color: #ffffff;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-nav {
            padding: 15px 0;
            flex-grow: 1;
        }

        .nav-category {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 10px 20px;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 10px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #ffffff;
            text-decoration: none;
            transition: 0.2s;
            font-size: 0.95rem;
        }

        .sidebar-nav a i {
            margin-right: 15px;
            font-size: 1.1rem;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #ffffff;
        }

        .sidebar-nav a.active {
            font-weight: 600;
        }

        /* Main Content Wrapper */
        #content-wrapper {
            margin-left: 250px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Topbar with Mountain Background */
        .topbar {
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=2000&q=80');
            background-size: cover;
            background-position: center;
            height: 140px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px 30px;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .topbar .user-welcome {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-welcome-logo {
            width: 45px;
            height: 45px;
            background-color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #274092;
            font-size: 1.2rem;
        }

        .topbar .date-display {
            font-size: 0.9rem;
            font-weight: 500;
            opacity: 0.9;
        }

        /* Content Area */
        .main-content {
            padding: 30px;
            flex-grow: 1;
            margin-top: -50px;
            /* Pull content up slightly over the mountain background */
        }

        /* Profile Card Overlap */
        .profile-card {
            background: white;
            border-radius: 8px;
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            border-left: 4px solid #274092;
        }

        .dropdown-toggle::after {
            vertical-align: middle;
        }

        .profile-dropdown-btn {
            background: none;
            border: none;
            color: #333;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            WIKRAMA
        </div>
        <div class="sidebar-nav">
            <div class="nav-category">Menu</div>
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('staff.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') || request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> Dashboard
            </a>

            <div class="nav-category">Items Data</div>
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.categories.index') }}"
                    class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="bi bi-collection"></i> Categories
                </a>
                <a href="{{ route('admin.items.index') }}"
                    class="{{ request()->routeIs('admin.items.*') ? 'active' : '' }}">
                    <i class="bi bi-box"></i> Items
                </a>
            @elseif(Auth::user()->role === 'staff')
                <a href="{{ route('staff.items.index') }}"
                    class="{{ request()->routeIs('staff.items.*') ? 'active' : '' }}">
                    <i class="bi bi-box"></i> Items
                </a>
                <a href="{{ route('staff.lendings.index') }}"
                    class="{{ request()->routeIs('staff.lendings.*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-left-right"></i> Lendings
                </a>
            @endif

            @if (Auth::user()->role === 'admin')
                <div class="nav-category">Accounts</div>
                <a href="{{ route('admin.users.index') }}"
                    class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Users
                </a>
            @endif
        </div>
    </nav>

    <!-- Main Wrapper -->
    <div id="content-wrapper">
        <!-- Topbar -->
        <header class="topbar">
            <div class="user-welcome">
                <div class="user-welcome-logo">
                    <i class="bi bi-building"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold">Welcome Back, {{ ucfirst(Auth::user()->role) }} Wikrama</h5>
                </div>
            </div>
            <div class="date-display">
                {{ \Carbon\Carbon::now()->format('d F, Y') }}
            </div>
        </header>

        <!-- Main Content -->
        <main class="main-content">

            <!-- Floating Menu Header Area -->
            <div class="profile-card">
                <div>
                    <h6 class="mb-0 text-muted">Check menu in sidebar</h6>
                </div>

                <!-- Profile & Logout Dropdown -->
                <div class="dropdown">
                    <button class="profile-dropdown-btn dropdown-toggle" type="button" id="profileDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-4 text-secondary"></i>
                        {{ Auth::user()->name ?? ucfirst(Auth::user()->role) . ' Wikrama' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="profileDropdown">
                        <li>
                            <form action="{{ url('/logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit"
                                    class="dropdown-item text-danger d-flex align-items-center gap-2">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Page Specific Content -->
            @yield('content')

        </main>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    @stack('scripts')
</body>

</html>
