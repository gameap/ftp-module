@php
/**
 * @var $ftpAccount \GameapModules\Ftp\Models\FtpAccount
**/
@endphp

@php($title = __('ftp::ftp_accounts.title_view'))

@extends('layouts.main')

@section('breadclumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">GameAP</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ftp') }}">FTP</a></li>
        <li class="breadcrumb-item active">{{ __('ftp::ftp_accounts.title_view') }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered detail-view">
                <tbody>
                    <tr>
                        <th>{{ __('labels.host') }} : {{ __('labels.port') }}</th>
                        <td>{{ $ftpAccount->host }}:{{ $ftpAccount->port }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('ftp::ftp_accounts.username') }}</th>
                        <td>{{ $ftpAccount->username }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('labels.password') }}</th>
                        <td>{{ $ftpAccount->password }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('ftp::ftp_accounts.link') }}</th>
                        <td><a href="{{ $ftpAccount->link }}">{{ $ftpAccount->link }}</a></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection
