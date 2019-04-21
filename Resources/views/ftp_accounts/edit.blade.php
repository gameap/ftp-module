@php($title = 'Edit FTP Account')

@extends('layouts.main')

@section('breadclumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">GameAP</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ftp') }}">FTP</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ftp.accounts.index') }}">FTP Accounts</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@section('content')
    @include('components.form.errors_block')

    {!! Form::model($ftpAccount, ['method' => 'PATCH','route' => ['admin.ftp.accounts.update', $ftpAccount->id]]) !!}

        <div class="row mt-2 mb-2">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        {{ Form::bsText('host') }}
                        {{ Form::bsText('port') }}

                        {{ Form::bsText('username') }}
                        {{ Form::bsText('password') }}

                        {{ Form::bsText('dir') }}
                    </div>
                </div>
            </div>
        </div>

        {{ Form::submit(__('main.save'), ['class' => 'btn btn-success']) }}
    {!! Form::close() !!}
@endsection
