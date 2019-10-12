<?php

namespace GameapModules\Ftp\Services;

use Gameap\Models\GdaemonTask;

/**
 * Class FtpService
 * @package GameapModules\Ftp\Services
 */
class FtpService
{
    const SCRIPT_NAME = './ftp.sh';
    const INSTALL_CMD = './ftp.sh install';
    const SCRIPT_DOWNLOAD_LINK = 'https://raw.githubusercontent.com/gameap/scripts/master/ftp/proftpd/ftp.sh';

    /**
     * @param integer $dedicatedServerId
     * @return mixed
     */
    public function install(int $dedicatedServerId)
    {
        $executeCommand = 'curl -O ' . self::SCRIPT_DOWNLOAD_LINK
            . ' && ' . 'chmod +x ' . self::SCRIPT_NAME
            . ' && ' . self::INSTALL_CMD;

        return GdaemonTask::create([
            'run_aft_id' => 0,
            'dedicated_server_id' => $dedicatedServerId,
            'task' => GdaemonTask::TASK_CMD_EXEC,
            'cmd' => $executeCommand,
        ])->id;
    }
}