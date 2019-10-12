@php($title = __('fastdl::fastdl.fastdl_last_error_title'))

@extends('layouts.main')

@section('breadclumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">GameAP</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ftp') }}">FTP</a></li>
        <li class="breadcrumb-item active">Last Error</li>
    </ol>
@endsection

@section('content')
    @if (!empty($lastError))
        <pre class="console">{!! $lastError !!}</pre>
    @else
        <div class="alert alert-success">{{ __('ftp::ftp_accounts.no_last_errors') }}</div>
    @endif
@endsection