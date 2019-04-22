@php($title = __('ftp::ftp_commands.title_edit'))

@extends('layouts.main')

@section('breadclumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">GameAP</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ftp') }}">FTP</a></li>
        <li class="breadcrumb-item active">{{ __('ftp::ftp_commands.title_edit') }}</li>
    </ol>
@endsection

@section('content')
    @include('components.form.errors_block')

    <div class="mb-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#commandExamples">
            {{ __('ftp::ftp_commands.command_examples') }}
        </button>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="commandExamples">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('ftp::ftp_commands.examples') }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('main.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="mb-2">
                        {!! __('ftp::ftp_commands.examples_descryption') !!}
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.close') }}</button>
                </div>
            </div>
        </div>
    </div>

    {!! Form::open(['method' => 'PATCH','route' => 'admin.ftp.commands.update']) !!}

        @foreach($dedicatedServers as $ds)
            <div class="card mb-5">
                <div class="card-header">
                    <h4>{{ $ds->name }}</h4>
                </div>

                <div class="card-body">
                    {{ Form::bsText('default_host[' . $ds->id . ']', $ftpCommands[$ds->id]->default_host ?? '', __('ftp::ftp_commands.default_host')) }}

                    {{ Form::bsInput('text', [
                        'name' => 'create_command[' . $ds->id . ']',
                        'value' => $ftpCommands[$ds->id]->create_command ?? '',
                        'label' => __('ftp::ftp_commands.create_command'),
                        'description' => __('ftp::ftp_commands.d_create_command')
                    ]) }}

                    {{ Form::bsInput('text', [
                        'name' => 'update_command[' . $ds->id . ']',
                        'value' => $ftpCommands[$ds->id]->update_command ?? '',
                        'label' => __('ftp::ftp_commands.update_command'),
                        'description' => __('ftp::ftp_commands.d_update_command')
                    ]) }}

                    {{ Form::bsInput('text', [
                        'name' => 'delete_command[' . $ds->id . ']',
                        'value' => $ftpCommands[$ds->id]->delete_command ?? '',
                        'label' => __('ftp::ftp_commands.delete_command'),
                        'description' => __('ftp::ftp_commands.d_delete_command')
                    ]) }}
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-2">{{ __('dedicated_servers.os') }}: {{ $ds->os }}</div>
                        <div class="col-md-2">{{ __('dedicated_servers.location') }}: {{ $ds->location }}</div>
                        <div class="col-md-2">{{ __('dedicated_servers.provider') }}: {{ $ds->provider }}</div>
                        <div class="col-md-4">{{ __('dedicated_servers.ip_list') }}: {{ implode(', ', $ds->ip) }}</div>
                    </div>

                </div>
            </div>
        @endforeach

        {{ Form::submit(__('main.save'), ['class' => 'btn btn-success']) }}
    {!! Form::close() !!}
@endsection
