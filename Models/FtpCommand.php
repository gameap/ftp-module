<?php

namespace GameapModules\Ftp\Models;

use Illuminate\Database\Eloquent\Model;
use Gameap\Models\DedicatedServer;

/**
 * Class FtpCommand
 *
 * @package GameapModules\Ftp\Models
 *
 * @property int $id
 * @property int $ds_id
 * @property string $default_host
 * @property string $create_command
 * @property string $update_command
 * @property string $delete_command
 *
 * @property DedicatedServer $dedicatedServer
 */
class FtpCommand extends Model
{
    const DEFAULT_CREATE_COMMAND = '{node_tools_path}/ftp.sh add --username="{username}" --password="{password}" --directory="{dir}" --user="{user}"';
    const DEFAULT_UPDATE_COMMAND = '{node_tools_path}/ftp.sh update --username="{username}" --password="{password}" --directory="{dir}"';
    const DEFAULT_DELETE_COMMAND = '{node_tools_path}/ftp.sh delete --username="{username}"';

    /** @var bool  */
    public $timestamps = false;

    /** @var array  */
    protected $fillable = [
        'ds_id',
        'default_host',
        'create_command',
        'update_command',
        'delete_command',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dedicatedServer()
    {
        return $this->belongsTo(DedicatedServer::class, 'ds_id');
    }
}
