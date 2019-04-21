<?php
/**
 * Created by PhpStorm.
 * User: nikita
 * Date: 4/21/19
 * Time: 4:10 PM
 */

namespace GameapModules\Ftp\Repositories;

use Illuminate\Support\Arr;
use GameapModules\Ftp\Models\FtpCommand;
use Gameap\Models\DedicatedServer;

class FtpCommandRepository
{
    public function updateAll($attributes)
    {
        $dedicatedServers = DedicatedServer::select('id')->get();

        foreach ($dedicatedServers as $ds) {
            if (!isset($attributes['create_command'][$ds->id])
                && !isset($attributes['update_command'][$ds->id])
                && !isset($attributes['delete_command'][$ds->id])
            ) {
                continue;
            }

            FtpCommand::updateOrCreate([
                'ds_id' => $ds->id,
            ], [
                'default_host' => $attributes['default_host'][$ds->id],
                'create_command' => $attributes['create_command'][$ds->id],
                'update_command' => $attributes['update_command'][$ds->id],
                'delete_command' => $attributes['delete_command'][$ds->id],
            ]);
        }
    }
}