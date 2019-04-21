@php($title = __('ftp::ftp_accounts.title_edit'))

@extends('layouts.main')

@section('breadclumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">GameAP</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ftp') }}">FTP</a></li>
        <li class="breadcrumb-item active">{{ __('ftp::ftp_accounts.title_edit') }}</li>
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

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{ Form::label('password', __('ftp::ftp_accounts.password'), ['class' => 'control-label']) }}

                            <div class="input-group">
                                {{ Form::input('password', 'password', $ftpAccount->password,
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

        {{ Form::submit(__('main.save'), ['class' => 'btn btn-success']) }}
    {!! Form::close() !!}
@endsection

@section('footer-scripts')
    <script src="{{ URL::asset('/js/formHelpers.js') }}"></script>
@endsection