@extends('templates.master')

@section('title', 'Owner')
@section('pwd', 'Coffee Shop')
@section('sub-pwd', 'Owner')
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
    <script src="{{asset('functions/owner/main.js')}}"></script>
@endpush