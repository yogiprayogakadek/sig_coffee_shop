@extends('templates.master')

@section('title', 'Kedai')
@section('pwd', 'Kedai')
@section('sub-pwd', 'Kedai')
@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="row render">
    {{--  --}}
</div>
@endsection

@push('script')
    <script src="{{asset('functions/kedai/main.js')}}"></script>
@endpush