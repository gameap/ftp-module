@php($title = "Ftp commands")

@extends('layouts.main')

@section('breadclumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">GameAP</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ftp') }}">FTP</a></li>
        <li class="breadcrumb-item active">Acconts</li>
    </ol>
@endsection

@section('content')
    <div class="mb-2">
        <a class='btn btn-success' href="{{ route('admin.ftp.accounts.create') }}">
            <span class="fa fa-plus-square"></span>&nbsp;Create
        </a>
    </div>

    @include('components.grid', [
        'modelsList' => $ftpAccounts,
        'labels' => ['Ftp Username', 'Host', 'Dedicated Server', 'User'],
        'attributes' => [
            'username',
            'host',
            'dedicatedServer.name',
            'user.login',
        ],
        // 'viewRoute' => 'admin.games.show',
        'editRoute' => 'admin.ftp.accounts.edit',
        'destroyRoute' => 'admin.ftp.accounts.destroy',
    ])

    {!! $ftpAccounts->links() !!}
@endsection