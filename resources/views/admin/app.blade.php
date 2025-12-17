<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Room Management System')</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 250px;
            --dark-sidebar: #1a1c24;
            --primary-color: #0d6efd;
            --accent-color: #6610f2;
            --light-bg: #f8f9fa;
            --card-radius: 14px;
        }

        body {
            font-family: "Inter", sans-serif;
            min-height: 100vh;
            background: #f4f6f9;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: var(--dark-sidebar);
            color: #fff;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 1.5rem 1rem;
            overflow-y: auto;
            transition: transform .3s ease;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0.5rem;
            border-radius: 8px;
            transition: all .2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: var(--primary-color);
            color: #fff;
            transform: translateX(5px);
        }

        .sidebar .nav-link i {
            font-size: 1.2rem;
        }

        .sidebar .brand {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .sidebar .brand i {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-right: 0.5rem;
        }

        .sidebar .small-text {
            font-size: 0.8rem;
            opacity: 0.7;
            margin-top: 2rem;
        }

        .content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: margin-left .3s ease;
        }

        .topbar {
            height: 60px;
            background: #fff;
            border-radius: var(--card-radius);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .metric-card {
            background: #fff;
            border-radius: var(--card-radius);
            padding: 1.5rem;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            transition: transform .2s;
        }

        .metric-card:hover {
            transform: translateY(-3px);
        }

        .metric-card .icon-circle {
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background: rgba(13, 110, 253, 0.1);
            font-size: 1.2rem;
        }

        .btn-grad {
            background: linear-gradient(90deg, #0d6efd, #6610f2);
            color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(13, 110, 253, 0.25);
            transition: all .3s;
        }

        .btn-grad:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(13, 110, 253, 0.35);
        }

        .table thead th {
            background: var(--primary-color);
            color: #fff;
        }

        .badge-available {
            background: #28a745;
        }

        .badge-occupied {
            background: #dc3545;
        }

        .badge-maintenance {
            background: #ffc107;
            color: #212529;
        }

        .badge-cleaning {
            background: #17a2b8;
        }

        @media (max-width:991px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1045;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
   @include('admin.sidebar')



    <!-- MAIN CONTENT -->
    <div class="content">



        <!-- TAB CONTENT -->
        <div class="tab-content">
            @yield('content')
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>

    </script>

</body>

</html>