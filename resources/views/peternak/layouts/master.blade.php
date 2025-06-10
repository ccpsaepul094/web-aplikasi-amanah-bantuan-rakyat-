<!-- resources/views/peternak/layouts/master.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>Peternak - Hibah Domba</title> --}}
        <title>@yield('title')</title>

    @include('peternak.includes.style')
</head>
<body>
        @include('peternak.includes.sidebar')
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
 @include('peternak.includes.script')


</body>
</html>
