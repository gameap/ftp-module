<?php

namespace GameapModules\Ftp\Http\Controllers;

use Illuminate\Http\Response;
use Gameap\Http\Controllers\AuthController;
use Gameap\Models\DedicatedServer;
use GameapModules\Ftp\Repositories\FtpAccountRepository;
use GameapModules\Ftp\Models\FtpAccount;
use GameapModules\Ftp\Http\Requests\FtpAccountRequest;

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
     * @param FtpAccountRequest $request
     * @return Response
     */
    public function store(FtpAccountRequest $request)
    {
        $this->repository->store($request->all());

        return redirect()->route('admin.ftp')
            ->with('success', __('ftp::ftp_accounts.create_success_msg'));
    }

    /**
     * Show the specified resource.
     *
     * @param int $id
     * @return Response
     */
    // public function show($id)
    // {
    //     return view('ftp::ftp_accounts.show');
    // }

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
     * @param FtpAccountRequest $request
     * @param int $id
     * @return Response
     */
    public function update(FtpAccountRequest $request, $id)
    {
        $this->repository->update($id, $request->all());

        return redirect()->route('admin.ftp')
            ->with('success', __('ftp::ftp_accounts.update_success_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FtpAccount $ftpAccount
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(FtpAccount $ftpAccount)
    {
        $this->repository->destroy($ftpAccount);

        return redirect()->route('admin.ftp')
            ->with('success', __('ftp::ftp_accounts.delete_success_msg'));
    }
}
