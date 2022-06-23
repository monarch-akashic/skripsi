<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Skripsi') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"> --}}
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

</head>

<body>
    <div class="main-container">
        <div class="wrapper">
            @include('inc.navbar')
            <div id="content">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn btn-info">
                            <i class="fas fa-align-left"></i>
                            {{-- <span>Toggle Sidebar</span> --}}
                        </button>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button"
                            data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-align-justify"></i>
                        </button>



                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <form class="form-inline" action="{{ action('PagesController@result') }}" method="POST" role="search">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="text" name="vacancy" class="form-control" placeholder="Search" style="margin:2px ; width: 100%; height: 40px">
                                {{-- <input type="submit" class="btn btn-custom" style="margin-left:2px ; width: 15%; height: 40px" value="Search"> --}}
                            </form>
                            <ul class="nav navbar-nav ml-auto">

                                <li class="nav-item">
                                    <a class="icon nav-link" id="bell">Inbox</a>
                                    <div class="notifications" id="box">
                                        <h2>Inbox Notifications - <span>{{}}</span></h2>
                                        <div class="notifications-item">
                                            {{-- <img src="https://i.imgur.com/uIgDDDd.jpg" alt="img"> --}}
                                            <div class="text">
                                                <h4>[Company XXX] Send an Invitation </h4>
                                                <p>You've been sent an interview schedule</p>
                                            </div>
                                        </div>
                                        <div class="notifications-item">
                                            {{-- <img src="https://i.imgur.com/uIgDDDd.jpg" alt="img"> --}}
                                            <div class="text">
                                                <h4>[Company XXX] Send an Invitation </h4>
                                                <p>You've been sent an interview schedule</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="/">Home</a>
                                </li>


                            </ul>
                        </div>
                    </div>
                </nav>
                @yield('content')
                {{-- @include('inc.footer') --}}
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>

    <script>
        $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script>
        var x = document.getElementById("demo");

        function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
        }

        function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
        "<br>Longitude: " + position.coords.longitude;
        }

        function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
            case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
            case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
            case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
        }
        }
    </script>

    <script>
        $(document).ready(function(){
            var down = false;
            $('#bell').click(function(e){

                var color = $(this).text();
                if(down){

                    $('#box').css('height','0px');
                    $('#box').css('opacity','0');
                    down = false;
                }else{

                    $('#box').css('height','auto');
                    $('#box').css('opacity','1');
                    down = true;
                }
            });
        });
    </script>

    <script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('article-ckeditor');
    </script>
</body>

</html>
