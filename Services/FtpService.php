<?php

namespace GameapModules\Ftp\Services;

use Gameap\Models\GdaemonTask;

/**
 * Class FtpService
 * @package GameapModules\Ftp\Services
 */
class FtpService
{
    const GET_COMMAND = "get-tool https://raw.githubusercontent.com/gameap/scripts/master/ftp/proftpd/ftp.sh";
    const INSTALL_COMMAND = '{node_tools_path}/ftp.sh install';

    /**
     * @param integer $dedicatedServerId
     * @return mixed
     */
    public function install(int $dedicatedServerId)
    {
        $getTask = GdaemonTask::create([
            'run_aft_id' => 0,
            'dedicated_server_id' => $dedicatedServerId,
            'task' => GdaemonTask::TASK_CMD_EXEC,
            'cmd' => self::GET_COMMAND,
        ]);

        $installTask = GdaemonTask::create([
            'run_aft_id' => 0,
            'dedicated_server_id' => $dedicatedServerId,
            'task' => GdaemonTask::TASK_CMD_EXEC,
            'cmd' => self::INSTALL_COMMAND,
        ]);

        return $getTask->id;
    }
}
