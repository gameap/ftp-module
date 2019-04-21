<?php
/**
 * Created by PhpStorm.
 * User: nikita
 * Date: 4/21/19
 * Time: 5:05 PM
 */

namespace GameapModules\Ftp\Services;

use Knik\Gameap\GdaemonCommands;
use Gameap\Models\DedicatedServer;
use GameapModules\Ftp\Models\FtpCommand;

class CommandsService
{
    /**
     * @var GdaemonCommands
     */
    protected $gdaemonCommands;

    /**
     * ServerService constructor.
     *
     * @param GdaemonCommands $gdaemonCommands
     */
    public function __construct(GdaemonCommands $gdaemonCommands)
    {
        $this->gdaemonCommands = $gdaemonCommands;
    }

    /**
     * @param $dsId
     * @param $login
     * @param $directory
     */
    public function addAccount($dsId, $username, $password, $dir)
    {
        $this->configureGdaemon($dsId);

        $ftpCommand = FtpCommand::where(['ds_id' => $dsId])->firstOrFail();

        $command = $this->replaceShortCodes($ftpCommand->create_command,
            compact('username', 'password', 'dir')
        );

        $this->gdaemonCommands->exec($command);
    }

    /**
     * @param $dsId
     * @param $username
     * @param $password
     * @param $dir
     */
    public function updateAccount($dsId, $username, $password, $dir)
    {
        $this->configureGdaemon($dsId);

        $ftpCommand = FtpCommand::where(['ds_id' => $dsId])->firstOrFail();

        $command = $this->replaceShortCodes($ftpCommand->update_command,
            compact('username', 'password', 'dir')
        );

        $this->gdaemonCommands->exec($command);
    }

    /**
     * @param $dsId
     * @param $username
     */
    public function deleteAccount($dsId, $username)
    {
        $this->configureGdaemon($dsId);

        $ftpCommand = FtpCommand::where(['ds_id' => $dsId])->firstOrFail();

        $command = $this->replaceShortCodes($ftpCommand->delete_command,
            compact('username')
        );

        $this->gdaemonCommands->exec($command);
    }

    /**
     * Setting up gdaemon commands configuration
     *
     * @param Server $server
     */
    private function configureGdaemon($dsId)
    {
        $dedicatedServer = DedicatedServer::findOrFail($dsId);

        $this->gdaemonCommands->setConfig(
            $dedicatedServer->gdaemonSettings()
        );
    }

    /**
     * @param string $command
     * @param array $codes
     * @return string
     */
    private function replaceShortCodes(string $command, array $codes)
    {
        foreach ($codes as $code => $value) {
            $command = str_replace('{' . $code . '}', $value, $command);
        }

        return $command;
    }
}