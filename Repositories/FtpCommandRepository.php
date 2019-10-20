<?php
/**
 * Created by PhpStorm.
 * User: nikita
 * Date: 4/21/19
 * Time: 4:10 PM
 */

namespace GameapModules\Ftp\Repositories;

use GameapModules\Ftp\Services\FtpService;
use Illuminate\Support\Arr;
use GameapModules\Ftp\Models\FtpCommand;
use Gameap\Models\DedicatedServer;
use League\Flysystem\Adapter\Ftp;

class FtpCommandRepository
{
    private $ftpService;

    /**
     * FtpCommandRepository constructor.
     * @param FtpService $ftpService
     */
    public function __construct(FtpService $ftpService)
    {
        $this->ftpService = $ftpService;
    }

    /**
     * @param array $attributes
     */
    public function updateAll(array $attributes)
    {
        $dedicatedServers = DedicatedServer::select('id')->get();

        foreach ($dedicatedServers as $ds) {
            FtpCommand::updateOrCreate([
                'ds_id' => $ds->id,
            ], [
                'default_host' => $attributes['default_host'][$ds->id] ?? '',
                'create_command' => $attributes['create_command'][$ds->id] ?? '',
                'update_command' => $attributes['update_command'][$ds->id] ?? '',
                'delete_command' => $attributes['delete_command'][$ds->id] ?? '',
            ]);
        }
    }

    /**
     * @param integer $dedicatedServerId
     */
    public function runAutosetup(int $dedicatedServerId)
    {
        $dedicatedServer = DedicatedServer::findOrFail($dedicatedServerId);

        FtpCommand::updateOrCreate([
            'ds_id' => $dedicatedServerId,
        ], [
            'default_host' => ($dedicatedServer->ip[0] ?? '0.0.0.0'),
            'create_command' => FtpCommand::DEFAULT_CREATE_COMMAND,
            'update_command' => FtpCommand::DEFAULT_UPDATE_COMMAND,
            'delete_command' => FtpCommand::DEFAULT_DELETE_COMMAND,
        ]);

        $this->ftpService->install($dedicatedServerId);
    }
}