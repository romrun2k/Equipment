<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Equipment</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- bootstrap -->
    {{-- <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css?v={{ time() }}"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- icon -->
    <link href="{{ asset('css/bootstrap/bootstrap-icons.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}?v={{ time() }}" rel="stylesheet">

    <!-- DataTable -->
    <link href="https://cdn.datatables.net/v/bs4/dt-2.0.8/r-3.0.2/datatables.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                @include('layouts.sidebar')
            </div>

            <div class="col py-3">
                <div>
                    @yield('pagetitle')
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstrap -->
    <script src="{{ asset('js/bootstrap/jquery.min.js') }}?v={{ time() }}"></script>
    {{-- <script src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js?v={{ time() }}"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js?v={{ time() }}"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>

    <!-- DataTable -->
    <script src="https://cdn.datatables.net/v/bs4/dt-2.0.8/r-3.0.2/datatables.min.js"></script>
    {{-- sweetalert2 --}}
    <script src="{{ asset('js/sweetalert2/sweetalert2.all.min.js') }}?v={{ time() }}"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}?v={{ time() }}"></script>
    @yield('script')

</body>

</html>
