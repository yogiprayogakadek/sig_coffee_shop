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
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
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
        <div id="SideMenu">
          <div class="card">
            <div class="card-header btn btn-default mh1" data-toggle="collapse" data-target="#MenuLayers" data-parent="#SideMenu">
              <i class="fa fa-map fa-fw"></i>&nbsp;Map Layers
            </div>
            <div id="MenuLayers" class="collapse show">
              <div class="card-block list-group mg1">
                <button type="button" class="list-group-item list-group-item-action"><i class="fa fa-question fa-fw"></i>&nbsp;Road</button>
                <button type="button" class="list-group-item list-group-item-action"><i class="fa fa-question fa-fw"></i>&nbsp;Hybrid</button>
                <button type="button" class="list-group-item list-group-item-action"><i class="fa fa-question fa-fw"></i>&nbsp;Item</button>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header btn btn-default mh1" data-toggle="collapse" data-target="#MenuStuff" data-parent="#SideMenu">
              <i class="fa fa-bullseye fa-fw"></i>&nbsp;Stuff 'n Junk
            </div>
            <div id="MenuStuff" class="collapse">
              <div class="card-block list-group mg1">
                <button type="button" class="list-group-item list-group-item-action"><i class="fa fa-question fa-fw"></i>&nbsp;Item</button>
                <button type="button" class="list-group-item list-group-item-action"><i class="fa fa-question fa-fw"></i>&nbsp;Item</button>
                <button type="button" class="list-group-item list-group-item-action"><i class="fa fa-question fa-fw"></i>&nbsp;Item</button>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header btn btn-default mh1" data-toggle="collapse" data-target="#MenuTools" data-parent="#SideMenu">
              <i class="fa fa-wrench fa-fw"></i>&nbsp;Tools
            </div>
            <div id="MenuTools" class="collapse">
              <div class="card-block list-group mg1">
                <button type="button" class="list-group-item list-group-item-action"><i class="fa fa-question fa-fw"></i>&nbsp;Item</button>
                <button type="button" class="list-group-item list-group-item-action"><i class="fa fa-question fa-fw"></i>&nbsp;Item</button>
                <button type="button" class="list-group-item list-group-item-action"><i class="fa fa-question fa-fw"></i>&nbsp;Item</button>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header btn btn-default mh1" data-toggle="collapse" data-target="#MenuSettings" data-parent="#SideMenu">
              <i class="fa fa-cog fa-fw"></i>&nbsp;Settings
            </div>
            <div id="MenuSettings" class="collapse">
              <div class="card-block list-group mg1">
                <button type="button" class="list-group-item list-group-item-action"><i class="fa fa-question fa-fw"></i>&nbsp;Item</button>
                <button type="button" class="list-group-item list-group-item-action"><i class="fa fa-question fa-fw"></i>&nbsp;Item</button>
                <button type="button" class="list-group-item list-group-item-action"><i class="fa fa-question fa-fw"></i>&nbsp;Item</button>
              </div>
            </div>
          </div>
        </div>
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

        function pushData() {
            @foreach ($kedai as $item)
                lat.push({{ $item->latitude }});
                long.push({{ $item->longitude }});
                nama.push('{{ $item->nama_kedai }}');
                searchData.push('{{ $item->nama_kedai }}');
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
                        $('#myModal').modal('show');
                        // infowindow.setContent(nama[i]);
                        // infowindow.open(map, marker);
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
                    long.push(data.longitude);
                    lat.push(data.latitude);
                    nama.push(data.nama_kedai);
                    // $('#map').empty();
                    initMap();
                });
            });

            // btn refresh
            $('body').on('click', '.btn-refresh', function() {
                pushData();
                initMap();
            })
        });
        

    </script>
</body>

</html>