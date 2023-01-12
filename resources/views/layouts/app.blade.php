<html>
    <head>
        <title>Dashboard</title>
    </head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <body>
        <div class="container">
            @include('inc.topnav')
            <br><br>
            <h3>Welcome</h3>
            <div>
                @yield('content')
            </div>
        </div>
    </body>
    </html>