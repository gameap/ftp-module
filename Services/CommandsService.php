<?php

namespace GameapModules\Ftp\Services;

use Gameap\Exceptions\GameapException;
use Gameap\Services\GdaemonCommandsService;
use GameapModules\Ftp\Exceptions\FTPCommandNotFoundException;
use GameapModules\Ftp\Exceptions\ServiceException;
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
    public function addAccount($dsId, $username, $password, $dir, $user, &$exitCode)
    {
        $ftpCommand = FtpCommand::where(['ds_id' => $dsId])->first();

        if ($ftpCommand === null) {
            throw new FTPCommandNotFoundException('Command not found');
        }

        $this->configureGdaemon($ftpCommand->dedicatedServer);

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
    public function updateAccount($dsId, $username, $password, $dir, $user, &$exitCode)
    {
        $ftpCommand = FtpCommand::where(['ds_id' => $dsId])->firstOrFail();

        if ($ftpCommand === null) {
            throw new FTPCommandNotFoundException('Command not found');
        }

        $this->configureGdaemon($ftpCommand->dedicatedServer);

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

        if ($ftpCommand === null) {
            throw new FTPCommandNotFoundException('Command not found');
        }

        $this->configureGdaemon($ftpCommand->dedicatedServer);

        $command = $this->replaceShortCodes($ftpCommand->delete_command,
            compact('username')
        );

        return $this->gdaemonCommands->exec($command, $exitCode);
    }
}
