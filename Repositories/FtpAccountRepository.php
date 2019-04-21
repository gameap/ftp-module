<?php

namespace GameapModules\Ftp\Repositories;

use GameapModules\Ftp\Models\FtpAccount;
use GameapModules\Ftp\Services\CommandsService;

class FtpAccountRepository
{
    /**
     * @var CommandsService
     */
    protected $commandsService;

    /**
     * ServerService constructor.
     *
     * @param CommandsService $gdaemonCommands
     */
    public function __construct(CommandsService $commandsService)
    {
        $this->commandsService = $commandsService;
    }

    /**
     * @param array $attributes
     */
    public function store(array $attributes)
    {
        $this->commandsService->addAccount(
            $attributes['ds_id'],
            $attributes['username'],
            $attributes['password'],
            $attributes['dir']
        );

        FtpAccount::create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     */
    function update(int $id, array $attributes)
    {
        $ftpAccount = FtpAccount::findOrFail($id);

        $this->commandsService->updateAccount(
            $ftpAccount->ds_id,
            $attributes['username'],
            $attributes['password'],
            $attributes['dir']
        );

        $ftpAccount->update($attributes);
    }

    /**
     * @param FtpAccount $ftpAccount
     * @throws \Exception
     */
    function destroy(FtpAccount $ftpAccount)
    {
        $this->commandsService->deleteAccount(
            $ftpAccount->ds_id,
            $ftpAccount->username
        );

        $ftpAccount->delete();
    }
}