@extends('main.mainpage.templates.master')
@section('title', 'SIG Coffee Shop')
@section('content')
<div class="container">
    <div class="section text-center">
        <h2 class="title">Coffee Shop</h2>
        <div class="team">
            <div class="row">
                @foreach ($kedai as $kedai)
                <div class="col-md-6">
                    <div class="card card-plain card-blog">
                        <div class="card-header card-header-image">
                            <a href="{{route('detail', $kedai->id_kedai)}}">
                                <img class="img img-raised" src="{{asset($kedai->foto)}}">
                            </a>
                            {{-- <a href="#">
                                <img class="img img-raised" src="{{asset($kedai->foto)}}">
                            </a> --}}
                            <div class="colored-shadow"
                                style="background-image: url({{asset($kedai->foto)}}); opacity: 1;"></div>
                        </div>
                        <div class="card-body">
                            <h6 class="card-category text-info">{{$kedai->nama_kedai}}</h6>
                            <h4 class="card-title">
                                {{-- <a href="{{route('mainpage.single-post', $kedai->id)}}">{{$kedai->kedai_name}}</a> --}}
                            </h4>
                            {{-- <p class="card-description">
                                {!! substr($kedai->description,0,150) !!}...
                            </p> --}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- <div class="section section-contacts">
        <div class="row">
            <div class="col-md-12 ml-auto mr-auto">
                <h2 class="text-center title">Ulasan Pengunjung</h2>
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <div id="carouselExampleIndicatorss" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @forelse ($feedbacks as $key => $feedback)
                                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                    <div class="card card-testimonial card-plain">
                                        <div class="card-avatar">
                                            <a href="#pablo">
                                                <img class="img" src="{{asset($feedback->user->traveler->image)}}">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-description">"{{$feedback->feedback}}"
                                            </h5>
                                            <h4 class="card-title">{{$feedback->user->traveler->name}}</h4>
                                            <h6 class="card-category text-muted">{{$feedback->touristPlace->place_name}}
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <h3 class="text-center font-weight-bold">Belum ada ulasan untuk tempat ini</h3>
                                @endforelse
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicatorss" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicatorss" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    @endsection

    @section('content-2')
    <div class="row">
        <div class="col-md-12 ml-auto mr-auto">
            <h2 class="text-center title">Ulasan Pengunjung</h2>
            <div class="row">
                <div class="col-md-12 ml-auto mr-auto">
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
                                        @for ($i = 0; $i < $ulasan->rating; $i++)  
                                            <i class="fa fa-star fa-rating fa-2x" style="color: white !important;"></i>
                                        @endfor
                                        <h5 class="card-description">"{{$ulasan->ulasan}}"
                                        </h5>
                                        <h4 class="card-title">{{$ulasan->user->nama}}</h4>
                                        <h6 class="card-category" style="color: white !important;">{{$ulasan->kedai->nama_kedai}}
                                    </div>
                                </div>
                            </div>
                            @empty
                            <h3 class="text-center font-weight-bold">Belum ada ulasan untuk tempat ini</h3>
                            @endforelse
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicatorss" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicatorss" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection