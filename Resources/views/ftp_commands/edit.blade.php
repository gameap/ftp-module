@php($title = "Edit FTP Commands")

@extends('layouts.main')

@section('breadclumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">GameAP</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ftp') }}">FTP</a></li>
        <li class="breadcrumb-item active">Commands</li>
    </ol>
@endsection

@section('content')
    @include('components.form.errors_block')

    <div class="mb-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#commandExamples">
            Command Examples
        </button>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="commandExamples">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Examples</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('main.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="mb-2">
                        <p align="center"><strong>Simple scripts</strong></p>
                        <p>Create Command:</p>
                        <code>./ftp_add.sh add --username="{username}" --password="{password}" --directory="{dir}"</code>

                        <p>Update Command:</p>
                        <code>./ftp_add.sh update --username="{username}" --password="{password}" --directory="{dir}"</code>

                        <p>Delete Command:</p>
                        <code>./ftp_add.sh delete --username="{username}"</code>
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
                    {{ Form::bsText('default_host[' . $ds->id . ']', $ftpCommands[$ds->id]->default_host ?? '', 'Default Host') }}

                    {{ Form::bsText('create_command[' . $ds->id . ']', $ftpCommands[$ds->id]->create_command ?? '', 'Create Command') }}
                    {{ Form::bsText('update_command[' . $ds->id . ']', $ftpCommands[$ds->id]->update_command ?? '', 'Update Command') }}
                    {{ Form::bsText('delete_command[' . $ds->id . ']', $ftpCommands[$ds->id]->delete_command ?? '', 'Delete Command') }}
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-2">OS: {{ $ds->os }}</div>
                        <div class="col-md-2">Location: {{ $ds->location }}</div>
                        <div class="col-md-2">Provider: {{ $ds->provider }}</div>
                        <div class="col-md-4">IP: {{ implode(', ', $ds->ip) }}</div>
                    </div>

                </div>
            </div>
        @endforeach

        {{ Form::submit(__('main.save'), ['class' => 'btn btn-success']) }}
    {!! Form::close() !!}
@endsection
