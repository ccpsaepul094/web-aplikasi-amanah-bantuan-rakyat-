<!-- resources/views/admin/layouts/master.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Hibah Domba</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            width: 200px;
            background-color: #f0f0f0;
            height: 100vh;
            padding: 20px;
            position: fixed;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
        }
        ul {
            list-style: none;
            padding-left: 0;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    @include('admin.includes.sidebar')
            <div id="app">
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
        @yield('content')

</div>
    </div>  
</body>
</html>

