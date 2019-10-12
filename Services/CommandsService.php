<?php

namespace GameapModules\Ftp\Services;

use Gameap\Exceptions\GameapException;
use Gameap\Services\GdaemonCommandsService;
use GameapModules\Ftp\Models\FtpCommand;

/**
 * Class CommandsService
 * @package GameapModules\Ftp\Services
 */
class CommandsService extends GdaemonCommandsService
{
    /**
     * Create new FTP account
     *
     * @param $dsId
     * @param $username
     * @param $password
     * @param $dir
     * @return mixed
     * @throws GameapException
     */
    public function addAccount($dsId, $username, $password, $dir, &$exitCode)
    {
        $ftpCommand = FtpCommand::where(['ds_id' => $dsId])->firstOrFail();

        $this->configureGdaemon($ftpCommand->dedicatedServer);
        $user = $ftpCommand->dedicatedServer->su_user;

        $command = $this->replaceShortCodes($ftpCommand->create_command,
            compact('username', 'password', 'dir', 'user')
        );

        return $this->gdaemonCommands->exec($command, $exitCode);
    }

    /**
     * Update FTP account
     *
     * @param $dsId
     * @param $username
     * @param $password
     * @param $dir
     * @return string
     * @throws GameapException
     */
    public function updateAccount($dsId, $username, $password, $dir, &$exitCode)
    {
        $ftpCommand = FtpCommand::where(['ds_id' => $dsId])->firstOrFail();

        $this->configureGdaemon($ftpCommand->dedicatedServer);
        $user = $ftpCommand->dedicatedServer->su_user;

        $command = $this->replaceShortCodes($ftpCommand->update_command,
            compact('username', 'password', 'dir', 'user')
        );

        return $this->gdaemonCommands->exec($command, $exitCode);
    }

    /**
     * Remove FTP account from Dedicated Server
     *
     * @param $dsId
     * @param $username
     * @return mixed
     * @throws GameapException
     */
    public function deleteAccount($dsId, $username, &$exitCode)
    {
        $ftpCommand = FtpCommand::where(['ds_id' => $dsId])->firstOrFail();

        $this->configureGdaemon($ftpCommand->dedicatedServer);

        $command = $this->replaceShortCodes($ftpCommand->delete_command,
            compact('username')
        );

        return $this->gdaemonCommands->exec($command, $exitCode);
    }
}