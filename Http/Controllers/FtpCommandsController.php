<?php

namespace GameapModules\Ftp\Http\Controllers;

use GameapModules\Ftp\Http\Requests\FtpAutosetupRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Gameap\Http\Controllers\AuthController;
use Gameap\Models\DedicatedServer;
use GameapModules\Ftp\Models\FtpCommand;
use GameapModules\Ftp\Http\Requests\FtpCommandRequest;
use GameapModules\Ftp\Repositories\FtpCommandRepository;

class FtpCommandsController extends AuthController
{
    /**
     * The GameRepository instance.
     *
     * @var \GameapModules\Ftp\Repositories\FtpCommandRepository
     */
    protected $repository;

    /**
     * Create a new GameController instance.
     *
     * @param  \GameapModules\Ftp\Repositories\FtpCommandRepository $repository
     */
    public function __construct(FtpCommandRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit()
    {
        $ftpCommands = FtpCommand::all()->keyBy('ds_id');

        return view('ftp::ftp_commands.edit', [
            'ftpCommands' => $ftpCommands,
            'dedicatedServers' => DedicatedServer::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param FtpCommandRequest $request
     * @param int $id
     * @return Response
     */
    public function update(FtpCommandRequest $request)
    {
        $this->repository->updateAll($request->all());

        return redirect()->route('admin.ftp')
            ->with('success', __('ftp::ftp_commands.update_success_msg'));
    }

    /**
     * @param FtpAutosetupRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function autosetup(FtpAutosetupRequest $request)
    {
        $dedicatedServerId = $request->post('dedicatedServer');

        $this->repository->runAutosetup($dedicatedServerId);

        return redirect()->route('admin.ftp')
            ->with('success', __('ftp::ftp_commands.autosetup_started_msg'));
    }
}
