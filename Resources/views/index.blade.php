@php($title = "Ftp commands")

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
            <span class="fa fa-plus-square"></span>&nbsp;Create
        </a>

        <a class='btn btn-light' href="{{ route('admin.ftp.commands.edit') }}">
            <span class="fa fa-cogs"></span>&nbsp;Commands
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
        'editRoute' => 'admin.ftp.accounts.edit',
        'destroyRoute' => 'admin.ftp.accounts.destroy',
    ])

    {!! $ftpAccounts->links() !!}
@endsection