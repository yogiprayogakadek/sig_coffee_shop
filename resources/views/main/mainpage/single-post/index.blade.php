@extends('main.mainpage.templates.master')

@section('title')
SIG Coffee Shop - {{$kedai->nama_kedai}}
@endsection

@section('content')
<div class="container">
    <div class="section">
        <h2 class="title text-center">{{$kedai->nama_kedai}}</h2>
        <div class="team">
            <div class="row">
                <div class="col-md-10 ml-auto mr-auto">
                    {!! $kedai->deskripsi !!}
                </div>
            </div>
        </div>
        {{-- Accommodation --}}
        {{-- <div class="row">
            <div class="col-md-4 ml-auto mr-auto">
                <h2 class="text-center title">Akomodasi</h2>
                <div class="card card-pricing card-plain">
                    <div class="card-body ">
                        <ul>
                            @forelse ($accommodations as $item)
                            <li>
                                <b>{{$loop->iteration}}</b> {{$item->name}}
                            </li>
                            @empty
                            <h3 class="text-center font-weight-bold">Belum ada informasi akomodasi untuk tempat ini.
                            </h3>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- Maps --}}
        <div class="row">
            <div class="col-md-12 ml-auto mr-auto">
                <h2 class="text-center title">Maps {{$kedai->nama_kedai}}</h2>
                <div class="row">
                    <div class="card card-testimonial">
                        <div class="card-body ">
                            <div class="map-inner">
                                <div id="map-canvas" style="height: 400px; width: 100%;"></div>
                                <div class="getDirection"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Gallery --}}
        <div class="row">
            <div class="col-md-12 ml-auto mr-auto">
                @can('guest')
                @if ($userHasFeedback == 0)
                <h2 class="text-center title">Ulasan</h2>
                <div class="media media-post">
                    <a class="author float-left" href="#pablo">
                        <div class="avatar">
                            <img class="media-object" alt="64x64"
                                src="{{asset(auth()->user()->foto)}}">
                        </div>
                    </a>
                    <div class="media-body">
                        <form id="formFeedback">
                            <div class="form-group label-floating bmd-form-group">
                                <label class="form-control-label bmd-label-floating" for="exampleBlogPost"> Masukkan
                                    ulasan menarik anda disini...</label>
                                <textarea class="form-control" rows="5" id="feedback" name="feedback"></textarea>
                                <div class="invalid-feedback error-feedback"></div>
                            </div>
                        </form>
                        <div class="media-footer">
                            <a href="javascript:void(0)"
                                class="btn btn-primary btn-round btn-wd float-right btn-feedback">Kirim
                                Ulasan</a>
                        </div>
                    </div>
                </div>
                @else
                <h2 class="text-center title">Anda sudah memberikan ulasan untuk tempat ini</h2>
                @endif
                @endcan
            </div>
        </div>

    </div>
@endsection

@section('content-2')
<div class="row">
    <div class="col-md-12 ml-auto mr-auto">
        <h2 class="text-center title">Ulasan Pengunjung</h2>
        <div class="col-md-12">
            <div id="carouselExampleIndicatorss" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @forelse ($ulasan as $key => $ulasan)
                    <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                        <div class="card card-testimonial card-plain">
                            <div class="card-avatar">
                                <a href="#pablo">
                                    <img class="img" src="{{asset($ulasan->user->foto)}}">
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-description">"{{$ulasan->ulasan}}"
                                </h5>
                                <h4 class="card-title">{{$ulasan->user->nama}}</h4>
                                </h6>
                            </div>
                        </div>
                    </div>
                    @empty
                    <h3 class="text-center font-weight-bold">Belum ada ulasan untuk tempat ini</h3>
                    @endforelse
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicatorss" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicatorss" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(initMap);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }

    function initMap(position) {
        let desLat = {{$kedai->latitude}};
        let desLong = {{$kedai->longitude}};
        let button = '<a href="https://www.google.com/maps/dir/?api=1&origin='+position.coords.latitude+','+position.coords.longitude+'&destination='+desLat+','+desLong+'" target="_blank"><button type=button class="mt-3 btn btn-primary">Lihat Dari Google Maps</button></a>';
        $('.getDirection').html(button)

        var pointA = new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
        // pointB = new google.maps.LatLng(-8.42027127774227, 115.35910193862952),
        pointB = new google.maps.LatLng(desLat, desLong),
        myOptions = {
            zoom: 7,
            center: pointA
        },
        map = new google.maps.Map(document.getElementById('map-canvas'), myOptions),
        // Instantiate a directions service.
        directionsService = new google.maps.DirectionsService,
        directionsDisplay = new google.maps.DirectionsRenderer({
            map: map
        }),
        markerA = new google.maps.Marker({
            position: pointA,
            title: "Asal",
            label: "A",
            map: map
        }),
        markerB = new google.maps.Marker({
            position: pointB,
            title: "Tujuan",
            label: "B",
            map: map
        });

        // get route from A to B
        calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB);
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB) {
        directionsService.route({
            origin: pointA,
            destination: pointB,
            // travelMode: google.maps.TravelMode.DRIVING
            travelMode: google.maps.TravelMode.WALKING
        }, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }

    // feedback
    let url = window.location.href.split('detail/');
    $('body').on('click', '.btn-feedback', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#formFeedback')[0]
        let data = new FormData(form)
        data.append('id_kedai', url[1])
        $.ajax({
            type: "POST",
            url: "/ulasan",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $('.btn-feedback').attr('disable', 'disabled')
                $('.btn-feedback').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function () {
                $('.btn-feedback').removeAttr('disable')
                $('.btn-feedback').html('Kirim Ulasan')
            },
            success: function (response) {
                // alert('sukses')
                toastr[response.status](response.message, response.title);
                // console.log(response.message)
                setTimeout(function(){
                    location.reload();
                }, 1500);
            },
            error: function (error) {
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.feedback) {
                            $('#feedback').addClass('is-invalid')
                            $('#feedback').trigger('focus')
                            $('.error-feedback').html(error.responseJSON.errors.feedback)
                        } else {
                            $('#feedback').removeClass('is-invalid')
                            $('.error-feedback').html('')
                        }
                    }
                }
            }
        });
    });

</script>
{{-- <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi4v5LQyLVl2YUfm3Xn3Kb746RO3L8BjA&callback=initMap&libraries=&v=weekly"
    async></script> --}}
@endsection