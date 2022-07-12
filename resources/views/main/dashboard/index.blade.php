@extends('templates.master')

@section('title', 'Dashboard')
@section('pwd', 'Dashboard')
@section('sub-pwd', 'Data')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
        <div class="alert alert-info">
            <i class="fa fa-exclamation-triangle"></i>
            <strong>Hai!</strong>
            Selamat datang
        </div>
        <div class="row">
            @foreach (menu() as $key => $menu)
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Jumlah {{$menu}}</h6>
                                <h2 class="mb-0 number-font">{{totalData($menu)}}</h2>
                            </div>
                        </div>
                        <a href="{{route(RouteUrl()[$key])}}">
                            <span class="text-muted fs-12">
                                <span class="text-secondary">
                                    <i class="fe fe-arrow-right-circle text-secondary"></i> Detail
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- <div class="card">
            <div class="card-header bg-info-transparent card-transparent">
                <h3 class="card-title text-info chart-title">Chart Penjualan Produk</h3>
                <div class="card-options">
                    <div class="form-group">
                        <select class="form-control" id="kategori">
                            <option value="">Pilih Kategori</option>
                            <option value="Pengadaan">Pengadaan</option>
                            <option value="Perbaikan">Perbaikan</option>
                            <option value="Perawatan">Perawatan</option>
                            <option value="Kerusakan">Kerusakan</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-left: 4px">
                        <select class="form-control" id="bulan">
                            <option value="">Pilih Bulan</option>
                            @foreach (bulan() as $key => $bulan)
                            <option value="{{$key+1}}">{{$bulan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="margin-left: 4px">
                        <select class="form-control" id="tahun">
                            <option value="">Pilih Tahun</option>
                            @for($i = 2022; $i <= 2030; $i++) <option value="{{$i}}">{{$i}}</option>
                                @endfor
                        </select>
                    </div>
                    <div class="form-group" style="margin-left: 4px">
                        <button class="btn btn-primary btn-lg" id="btn-search">
                            <i class="fe fe-refresh-cw"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body render"></div>
        </div> --}}
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush