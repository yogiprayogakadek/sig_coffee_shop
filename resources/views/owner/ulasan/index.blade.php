@extends('templates.master')

@section('title', 'Ulasan')
@section('pwd', 'Ulasan')
@section('sub-pwd', 'Data')
@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="row render">
    {{--  --}}
</div>
@endsection

@push('script')
    <script src="https://spruko.com/demo/sash/sash/assets/plugins/select2/select2.full.min.js"></script>
    <script src="{{asset('functions/ulasan/main.js')}}"></script>
@endpush