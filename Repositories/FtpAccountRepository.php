<?php

namespace GameapModules\Ftp\Repositories;

use Exception;
use Gameap\Exceptions\GameapException;
use GameapModules\Ftp\Exceptions\ExecuteCommandException;
use GameapModules\Ftp\Models\FtpAccount;
use GameapModules\Ftp\Services\CommandsService;
use Cache;

class FtpAccountRepository
{
    const EXEC_SUCCESS_CODE = 0;

    const CACHE_TTL_SECONDS = 300;
    const CACHE_LAST_ERROR_KEY = 'ftp:last_error';

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
     * @throws ExecuteCommandException
     * @throws GameapException
     */
    public function store(array $attributes)
    {
        $result = $this->commandsService->addAccount(
            $attributes['ds_id'],
            $attributes['username'],
            $attributes['password'],
            $attributes['dir'],
            $exitCode
        );

        if ($exitCode !== self::EXEC_SUCCESS_CODE) {
            Cache::put(self::CACHE_LAST_ERROR_KEY, $result, self::CACHE_TTL_SECONDS);
            throw new ExecuteCommandException();
        }

        FtpAccount::create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @throws ExecuteCommandException
     * @throws GameapException
     */
    function update(int $id, array $attributes)
    {
        $ftpAccount = FtpAccount::findOrFail($id);

        $result = $this->commandsService->updateAccount(
            $ftpAccount->ds_id,
            $attributes['username'] ?? $ftpAccount->username,
            $attributes['password'],
            $attributes['dir'],
            $exitCode
        );

        if ($exitCode !== self::EXEC_SUCCESS_CODE) {
            Cache::put(self::CACHE_LAST_ERROR_KEY, $result, self::CACHE_TTL_SECONDS);
            throw new ExecuteCommandException();
        }

        $ftpAccount->update($attributes);
    }

    /**
     * @param FtpAccount $ftpAccount
     * @throws ExecuteCommandException
     * @throws GameapException
     * @throws Exception
     */
    function destroy(FtpAccount $ftpAccount)
    {
        $result = $this->commandsService->deleteAccount(
            $ftpAccount->ds_id,
            $ftpAccount->username,
            $exitCode
        );

        if ($exitCode !== self::EXEC_SUCCESS_CODE) {
            Cache::put(self::CACHE_LAST_ERROR_KEY, $result, self::CACHE_TTL_SECONDS);
            throw new ExecuteCommandException();
        }

        $ftpAccount->delete();
    }

    /**
     * @return mixed
     */
    function lastError()
    {
        return Cache::get(self::CACHE_LAST_ERROR_KEY);
    }
}