<?php

namespace GameapModules\Ftp\Http\Controllers;

use Gameap\Exceptions\GameapException;
use GameapModules\Ftp\Exceptions\ExecuteCommandException;
use GameapModules\Ftp\Http\Requests\FtpAccountUpdateRequest;
use Illuminate\Http\Response;
use Gameap\Http\Controllers\AuthController;
use Gameap\Models\DedicatedServer;
use GameapModules\Ftp\Repositories\FtpAccountRepository;
use GameapModules\Ftp\Models\FtpAccount;
use GameapModules\Ftp\Http\Requests\FtpAccountCreateRequest;

class FtpAccountsController extends AuthController
{
    /**
     * The GameRepository instance.
     *
     * @var \GameapModules\Ftp\Repositories\FtpAccountRepository
     */
    protected $repository;

    /**
     * Create a new GameController instance.
     *
     * @param  \GameapModules\Ftp\Repositories\FtpAccountRepository $repository
     */
    public function __construct(FtpAccountRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('ftp::ftp_accounts.list', [
            'ftpAccounts' => FtpAccount::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('ftp::ftp_accounts.create', [
            'dedicatedServers' => DedicatedServer::all()->pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FtpAccountCreateRequest $request
     * @return Response
     * @throws GameapException
     */
    public function store(FtpAccountCreateRequest $request)
    {
        try {
            $this->repository->store($request->all());
        } catch (ExecuteCommandException $exception) {
            return redirect()->route('admin.ftp')
                ->with('error', __('ftp::ftp_accounts.create_fail_msg'));
        }

        return redirect()->route('admin.ftp')
            ->with('success', __('ftp::ftp_accounts.create_success_msg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(FtpAccount $ftpAccount)
    {
        return view('ftp::ftp_accounts.edit', [
            'ftpAccount' => $ftpAccount
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FtpAccountCreateRequest $request
     * @param int $id
     * @return Response
     * @throws GameapException
     */
    public function update(FtpAccountUpdateRequest $request, $id)
    {
        try {
            $this->repository->update($id, $request->all());
        } catch (ExecuteCommandException $exception) {
            return redirect()->route('admin.ftp')
                ->with('error', __('ftp::ftp_accounts.update_fail_msg'));
        }

        return redirect()->route('admin.ftp')
            ->with('success', __('ftp::ftp_accounts.update_success_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FtpAccount $ftpAccount
     * @return \Illuminate\Http\RedirectResponse
     * @throws GameapException
     */
    public function destroy(FtpAccount $ftpAccount)
    {
        try {
            $this->repository->destroy($ftpAccount);
        } catch (ExecuteCommandException $exception) {
            return redirect()->route('admin.ftp')
                ->with('error', __('ftp::ftp_accounts.delete_fail_msg'));
        }

        return redirect()->route('admin.ftp')
            ->with('success', __('ftp::ftp_accounts.delete_success_msg'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lastError()
    {
        $lastError = $this->repository->lastError();
        return view('ftp::ftp_accounts.last_error', compact('lastError'));
    }
}
