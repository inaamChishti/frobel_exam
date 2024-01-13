<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Add the CSS import for Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom CSS -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        @import url(https://unpkg.com/@webpixels/css@1.1.5/dist/index.css);
    </style>

    <!-- Latest version of Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Add the CSS import for Bootstrap Icons -->
    <style>
        @import url("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css");
    </style>
 <style>
    @import url("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css");
</style>
<style>
    /* Custom Styles */
    body {
        padding-top: 60px;
        /* Add padding to the top of the body to make space for the header */
    }

    .sidebar {
        position: fixed;
        top: 60px;
        /* Place the sidebar below the header */
        bottom: 0;
        left: 0;
        width: 250px;
        /* Set the width of the sidebar */
        padding-top: 1rem;
        /* Add some padding to the top of the sidebar */
        background-color: #f8f9fa;
        /* Set the background color of the sidebar */
    }
    @media (max-width: 767px) {
    .sidebar {
        position: relative; /* Change to 'position: relative;' for mobile screens */
    }
}
    /* Adjust the container's margin to make space for the sidebar */
    .container {
        margin-left: 250px;
        /* Should be equal to the width of the sidebar */
    }

    /* below is logout css */
    /* Styles for the current user name (white color) */
    #navbarDropdown {
        color: white;
    }

    /* Styles for the toggle button (using Bootstrap classes) */
    .dropdown-menu-end .dropdown-item {
        display: flex;
        align-items: center;
    }

    .dropdown-menu-end .dropdown-item:hover {
        background-color: #f8f9fa;
        /* Add a background color on hover */
    }

    .dropdown-menu-end .dropdown-item .bi {
        margin-right: 5px;
    }

    /*  */
    body {
        padding-top: 60px;
        /* Add padding to the top of the body to make space for the header */
    }

    /* Ensure the header stays on top */
    .header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background-color: #292222;
        color: white;
        text-align: center;
        padding: 0px;
        z-index: 100;
    }

    .sidebar {
        /* ... Your existing styles ... */
        z-index: 50;
        /* Set z-index to a higher value than the main content to ensure it stays on top */
    }

    .main-content {
        /* ... Your existing styles ... */
        z-index: 0;
        /* Set z-index to 0 to ensure it stays below the fixed header and sidebar */
        position: relative;
        /* Add position relative to ensure correct stacking context */
    }

    /* Inline styles for demonstration purposes. It's better to use an external CSS file in a real project. */
    .nav-item.dropdown {

        position: relative;
    }

    .dropdown-menu {
        position: absolute;
        right: 0;
    }

    /* Your regular link styles */
    .nav-link {
        color: #333;
        /* Change to your preferred color */
    }

    /* Active link styles */
    .nav-item.active .nav-link {
        color: #000000;
        /* Change to your preferred active color */
        background-color: #a0b0b361;
        /* Change to your preferred active background color */
    }

    /* Hover effect */
    .nav-item:not(.active):hover .nav-link {
        background-color: #f8f8f8;
        /* Change to your preferred hover background color */
        /* Add any other hover styles as needed */
    }
</style>
</head>
<body >
   <div id="app">
            {{-- navbar start --}}
            <div class="header" style="display: flex; justify-content: space-between; align-items: center; background-color: #b2e4edd6; color: white; padding: 10px;">
                <div class="logo" style="display: flex; align-items: center;">
                    <img src="https://frobelschoolsystemnew.frobel.co.uk/img/FrobelEducationWhite%20(1).png" alt="Logo" style="width: 150%; height: 30px; margin-right: 10px;">
                </div>
                {{-- <div class="menu" style="display: flex; align-items: center;">
                    <ul style="list-style: none; display: flex; align-items: center; margin: 0;">
                        <li style="margin-left: 20px; position: relative;">
                            <a href="#" style="color: #fff; text-decoration: none;" onclick="toggleNotificationDropdown()">Notification
                                @php
                                    $unreadCount = auth()->user()->unreadNotifications->count();
                                @endphp
                                 @if ($unreadCount > 0)
                                 <span style="background-color: rgb(247, 242, 242); color: rgb(6, 1, 1); padding: 4px 8px; border-radius: 50%; font-size: 12px; margin-left: 5px;">{{ $unreadCount }}</span>
                             @endif
                            </a>
                            <span class="notification-dropdown mt-3" style="display: none; color: rgb(211, 161, 161); position: absolute; background-color: rgb(83 80 80); padding: 10px; right: 0; min-width: 300px;" id="notificationDropdown">
                                @forelse (auth()->user()->notifications as $notification)
                                <div style="position: relative; display: inline-flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #555; padding-bottom: 8px;">
                                    <a href="#" style="color: {{ $notification->read_at ? 'gray' : 'white' }}; font-size: 14px; flex: 1; text-decoration: none; padding-right: 30px;">
                                        <i class="bi bi-bell-fill"></i> {{ $notification->data['body'] }}
                                    </a>
                                    <div class="mt-2" style="position: relative; display: flex; align-items: center;">
                                        <a href="{{ url('markAsRead/'.$notification->id) }}" style="display: inline-block; padding: 4px 16px; background-color: lightgray; color: {{ $notification->read_at ? 'darkgray' : 'rgb(0, 0, 0)' }}; text-decoration: none; border-radius: 4px; font-size: 12px;">Read</a>
                                    </div>
                                </div>
                            @empty

                                    <a href="" style="color: white; font-size: 14px; text-decoration: none; display: inline-block;">
                                        <i class="bi bi-bell-fill"></i> No new notifications
                                    </a>
                                @endforelse
                            </span>
                        </li>
                        <li style="margin-left: 20px;">
                            <a href="{{url('logoutCustom')}}" style="color: white; text-decoration: none;" onclick="logout()">Logout</a>
                        </li>
                    </ul>
                </div> --}}
                <div class="menu" style="display: flex; align-items: center;">
                    <ul style="list-style: none; display: flex; align-items: center; margin: 0;">
                        <li style="margin-left: 20px; position: relative;">
                            <a href="#" style="color: #fff; text-decoration: none;"
                                onclick="toggleNotificationDropdown()"><b style="color: black">Notification</b>
                                @php
                                    $unreadCount = auth()
                                        ->user()
                                        ->unreadNotifications->count();
                                @endphp
                                @if ($unreadCount > 0)
                                    <span
                                    style="background-color: rgb(247, 242, 242); color: rgb(6, 1, 1); padding: 4px 8px; border-radius: 50%; font-size: 12px; margin-left: 5px;">{{ $unreadCount }}</span>
                                @endif
                            </a>
                            <span class="notification-dropdown mt-3"
                                style="display: none; color: rgb(211, 161, 161); position: absolute; background-color: rgb(83 80 80); padding: 10px; right: 0; min-width: 300px;"
                                id="notificationDropdown">
                                @forelse (auth()->user()->notifications as $notification)
                                    <div
                                        style="position: relative; display: inline-flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #555; padding-bottom: 8px;">
                                        <a href="#"
                                            style="color: {{ $notification->read_at ? 'gray' : 'white' }}; font-size: 14px; flex: 1; text-decoration: none; padding-right: 30px;">
                                            <i class="bi bi-bell-fill"></i> {{ $notification->data['body'] }}
                                        </a>
                                        <div class="mt-2" style="position: relative; display: flex; align-items: center;">
                                            <a href="{{ url('markAsRead/' . $notification->id) }}"
                                                style="display: inline-block; padding: 4px 16px; background-color: lightgray; color: {{ $notification->read_at ? 'darkgray' : 'rgb(0, 0, 0)' }}; text-decoration: none; border-radius: 4px; font-size: 12px;">Read</a>
                                        </div>
                                    </div>
                                @empty

                                    <a href=""
                                        style="color: white; font-size: 14px; text-decoration: none; display: inline-block;">
                                        <i class="bi bi-bell-fill"></i> No new notifications
                                    </a>
                                @endforelse
                            </span>
                        </li>
                        <li style="margin-left: 20px;">
                            <a href="{{ url('logoutCustom') }}" style="color: white; text-decoration: none;"
                                onclick="logout()"> <b style="color: black">Logout</b> </a>
                        </li>
                    </ul>
                </div>

            </div>
            <!-- Rest of your content goes here -->


            {{-- navbar end --}}

        <div class="sidebar"  style=" margin-top: -22px;">
<!-- Dashboard -->
<div  style="background-color:#535353;" class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
    <!-- Vertical Navbar -->
    <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->

            <div class="offset-md-2" style="display: flex; align-items: flex-end;">
                <i>
                  {{-- <img src="data:image/png;base64,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" alt="" width="30px;" height="40px;" style="margin-bottom: 5px;">
                  <b style="margin-top: 10px;">Welcome {{ explode(' ', auth()->user()->name)[0] }}</b> --}}
                  <b>{{ \Carbon\Carbon::now()->format('l j M Y') }}</b>
                </i>
              </div>
            <hr>
            <!-- User menu (mobile) -->

            <!-- Collapse -->

            <div class="collapse navbar-collapse offset-md-1" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav">
                    {{-- <li class="nav-item {{ request()->is('home') ? 'active' : '' }}" style="background-color: #b2e4edd6;height: 30px; position: relative;">
                        <a class="nav-link" href="{{ url('home') }}" style="height: 30px;">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li> --}}

                    <li class="mt-2 nav-item {{ request()->is('home') ? 'active' : '' }}" style="background-color: #b2e4edd6;height: 30px; position: relative;">
                        <a class="nav-link" href="{{ url('home') }}" style="height: 30px; text-decoration: none;">
                            <i class="bi bi-house"></i> <b>Dashboard</b> <i class="fa fa-arrow-right" style="position: absolute; right: 6px;  font-weight: bold; color: black;"></i>
                        </a>
                        <div id="popupList" class="popup-list " style="display: none; position: absolute; top: 100%; right: 0; background-color: #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); min-width: 100px; z-index: 1;">
                            <a href="#" style="height: 30px; padding: 10px; display: flex; align-items: center; text-decoration: none; color: black; border: 1px solid gray; background-color: #b2e4edd6;">Option 1</a>
                            <a href="#" style="height: 30px; padding: 10px; display: flex; align-items: center; text-decoration: none; color: black; border: 1px solid gray; border-top: none; background-color: #b2e4edd6;">Option 2</a>
                            <!-- Add more options here as needed -->
                        </div>




                    </li>

                    <script>
                        const navItem = document.querySelector('.nav-item');
                        const popupList = document.getElementById('popupList');

                        navItem.addEventListener('mouseenter', () => {
                            popupList.style.display = 'block';
                        });

                        navItem.addEventListener('mouseleave', () => {
                            popupList.style.display = 'none';
                        });
                    </script>


                    {{-- <li class="nav-item {{ request()->is('modifyExamDate') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('modifyExamDate') }}">
                            <i class="fas fa-calendar-alt"></i> Modify Exam Dates
                        </a>
                    </li> --}}
                    <li class=" mt-2 nav-item {{ request()->is('examSession') ? 'active' : '' }}" style="background-color: #b2e4edd6;height: 30px; position: relative;">
                        <a class="nav-link" href="{{ url('examSession') }}" style="height: 30px;">
                            <i class="fas fa-calendar-alt"></i> Exam Session
                        </a>
                    </li>

                    <li class=" mt-2 nav-item {{ request()->is('modifyStatement') ? 'active' : '' }}" style="background-color: #b2e4edd6;height: 30px; position: relative;">
                        <a class="nav-link" href="{{ url('modifyStatement') }}" style="height: 30px;">
                            <i class="fas fa-calendar-alt"></i> Issue Statement of entry
                        </a>
                    </li>
                    <li class=" mt-2 nav-item {{ request()->is('viewPayments') ? 'active' : '' }}" style="background-color: #b2e4edd6;height: 30px; position: relative;">
                        <a class="nav-link" href="{{ url('viewPayments') }}" style="height: 30px;">
                            <i class="fas fa-money-check-alt"></i> Show Payments
                        </a>
                    </li>
                    <li class=" mt-2 nav-item {{ request()->is('invoice') ? 'active' : '' }}" style="background-color: #b2e4edd6;height: 30px; position: relative;">
                        <a class="nav-link" href="{{ url('invoice') }}" style="height: 30px;">
                            <i class="fas fa-money-check-alt"></i> Invoices
                        </a>
                    </li>

                    <li class=" mt-2 nav-item" style="background-color: #b2e4edd6;height: 30px; position: relative;">
                        <a class="nav-link" href="#" style="height: 30px;" >
                            <i class="bi bi-chat"></i> Messages
                            <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto">6</span>
                        </a>
                    </li>
                    <li class=" mt-2 nav-item" style="background-color: #b2e4edd6;height: 30px; position: relative;">
                        <a class="nav-link" href="#" style="height: 30px;">
                            <i class="bi bi-bookmarks"></i> Collections
                        </a>
                    </li>
                    <li class=" mt-2 nav-item" style="background-color: #b2e4edd6;height: 30px; position: relative;">
                        <a class="nav-link" href="#" style="height: 30px;">
                            <i class="bi bi-people"></i> Users
                        </a>
                    </li>
                </ul>
                <!-- Divider -->

                <!-- Navigation -->

                <!-- Push content down -->
                <div class="mt-auto"></div>
                <!-- User (md) -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-person-square"></i> Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-box-arrow-left"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main content -->

</div>
        </div>


        <main class="py-4">
            <div class="main-content" style="wdth:100%;height:100%;"> <!-- Add the "main-content" class to the main content container -->
                @yield('content')
            </div>
        </main>
        <script>
            function toggleNotificationDropdown() {
                var dropdown = document.getElementById("notificationDropdown");
                dropdown.style.display = dropdown.style.display === "none" ? "block" : "none";
            }

        </script>
    </div>
</body>
</html>
