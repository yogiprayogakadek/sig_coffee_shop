<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/frontend/landing-page/css/typehead.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/landing-page/css/modal.css')}}">
    <style type="text/css">
        html,
        body {
            height: 100%;
        }
        #map {
            height: 100%;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('main')}}">
                <img src="{{asset('assets/frontend/landing-page/img/pesona-indonesia.png')}}" width="20" height="20" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('main')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Search</a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a href="{{route('login')}}" class="nav-link">
                            <i class="fa fa-lock"></i> Login
                        </a>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->nama}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                        {{-- <a href="{{route('logout')}}" class="dropdown-item" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="ti-lock text-muted me-2"></i>{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form> --}}
                    </li>
                    @endguest
                </ul>
                <div class="d-flex col-sm-3">
                    <input class="form-control me-2 typeahead" type="search" placeholder="cari tempat..." aria-label="Search">
                    <button class="btn btn-outline-success btn-refresh" type="button" style="margin-left: 10px">Refresh</button>
                </div>
            </div>
        </div>
    </nav>
    <div id="map" style="height: 100%"></div>

    {{-- modal --}}
    <div class="modal left fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                assa
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
    {{-- end modal --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script> --}}
    <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi4v5LQyLVl2YUfm3Xn3Kb746RO3L8BjA&callback=initMap&libraries=&v=weekly"
        async></script>
    <script type="text/javascript">
        var lat = [];
        var long = [];
        var nama = [];
        var searchData = [];
        var id_kedai = [];

        function pushData() {
            @foreach ($kedai as $item)
                lat.push({{ $item->latitude }});
                long.push({{ $item->longitude }});
                nama.push('{{ $item->nama_kedai }}');
                searchData.push('{{ $item->nama_kedai }}');
                id_kedai.push({{ $item->id_kedai }});
            @endforeach
        }

        pushData();

        function initMap() {
            const myLatLng = { lat: -8.650000, lng: 115.216667 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: myLatLng,
            });

            var infowindow = new google.maps.InfoWindow();
            var marker, i;

            for (i = 0; i < long.length; i++) {  
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(lat[i], long[i]),
                    map: map
                });
                
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        // $('#myModal').modal('show');
                        // infowindow.setContent(nama[i]);
                        // infowindow.setContent('<button class="btn btn-primary">'+nama[i]+'</button>');
                        infowindow.setContent('<a href="{{url('/detail/')}}/'+id_kedai[i]+'">'+nama[i]+'</a>');
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
        window.initMap = initMap;

        $(document).ready(function(){
            // Constructing the suggestion engine
            var searchData = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: nama
            });
            
            // Initializing the typeahead
            $('.typeahead').typeahead({
                hint: true,
                highlight: true, /* Enable substring highlighting */
                minLength: 1 /* Specify minimum characters required for showing suggestions */
            },
            {
                name: 'searchData',
                source: searchData
            }).on('typeahead:selected', function (obj, datum) {
                $.get("/search/keyword/"+datum, function (data) {
                    long = [];
                    lat = [];
                    nama = [];
                    id_kedai = [];
                    long.push(data.longitude);
                    lat.push(data.latitude);
                    nama.push(data.nama_kedai);
                    id_kedai.push(data.id_kedai);
                    // $('#map').empty();
                    initMap();
                });
            });

            // btn refresh
            $('body').on('click', '.btn-refresh', function() {
                $('.typeahead').val('');
                pushData();
                initMap();
            })
        });
        

    </script>
</body>

</html>