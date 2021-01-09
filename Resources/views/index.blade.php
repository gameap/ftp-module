@php($title = "FTP Manager")

@extends('layouts.main')

@section('breadclumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">GameAP</a></li>
        <li class="breadcrumb-item active">FTP</li>
    </ol>
@endsection

@section('content')
    <div class="mb-2">
        <a class='btn btn-success' href="{{ route('admin.ftp.accounts.create') }}">
            <span class="fa fa-plus-square"></span>&nbsp;{{ __('main.create') }}
        </a>

        <a class='btn btn-warning' href="{{ route('admin.ftp.accounts.last_error') }}">
            <i class="fas fa-exclamation-triangle"></i>&nbsp;{{ __('ftp::ftp_accounts.last_error') }}
        </a>

        <a class='btn btn-light' href="{{ route('admin.ftp.commands.edit') }}">
            <span class="fa fa-cogs"></span>&nbsp;{{ __('ftp::ftp_commands.commands') }}
        </a>
    </div>

    @include('components.grid', [
        'modelsList' => $ftpAccounts,
        'labels' => [
            __('ftp::ftp_accounts.username'),
            __('labels.host') . ':' . __('labels.port'),
            __('servers.dedicated_server')
        ],
        'attributes' => [
            'username',
            ['twoSeparatedValues', ['host', ':', 'port']],
            'dedicatedServer.name',
        ],
        'viewRoute' => 'admin.ftp.accounts.show',
        'editRoute' => 'admin.ftp.accounts.edit',
        'destroyRoute' => 'admin.ftp.accounts.destroy',
    ])

    {!! $ftpAccounts->links() !!}
@endsection
