<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventory Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body class="bg-light">

<div class="container-fluid">

    <div class="row">

        <div class="col-md-2 p-0">

            @include('layouts.sidebar')

        </div>

        <div class="col-md-10 p-0">

            @include('layouts.navbar')

            <div class="p-4">

                @yield('content')

            </div>

        </div>

    </div>

</div>

</body>

</html>