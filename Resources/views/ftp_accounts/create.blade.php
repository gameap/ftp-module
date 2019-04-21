@php($title = 'Create FTP Account')

@extends('layouts.main')

@section('breadclumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">GameAP</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ftp') }}">FTP</a></li>
        <li class="breadcrumb-item active">Create FTP account</li>
    </ol>
@endsection

@section('content')
    @include('components.form.errors_block')

    {!! Form::open(['url' => route('admin.ftp.accounts.store')]) !!}
        <div class="row mt-2 mb-2">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group" id="dedicatedServerForm">
                            {{ Form::label('ds_id', 'Dedicated server', ['class' => 'control-label']) }}
                            {{ Form::select('ds_id', $dedicatedServers, null, ['class' => 'form-control']) }}
                        </div>

                        {{ Form::bsText('host') }}
                        {{ Form::bsText('port') }}

                        {{ Form::bsText('username') }}

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{ Form::label('password', null, ['class' => 'control-label']) }}

                            <div class="input-group">
                                {{ Form::input('password', 'password', null,
                                    ['class' => 'form-control password', 'autocomplete' => 'new-password']) }}

                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary show-hide-password" type="button"><i class="far fa-eye"></i></button>
                                </div>
                            </div>
                        </div>

                        {{ Form::bsText('dir') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="form-group">
                {{ Form::submit(__('main.create'), ['class' => 'btn btn-success']) }}
            </div>
        </div>
    {!! Form::close() !!}
@endsection

@section('footer-scripts')
    <script src="{{ URL::asset('/js/formHelpers.js') }}"></script>
@endsection