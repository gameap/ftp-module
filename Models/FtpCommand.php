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
 */
class FtpCommand extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'ds_id',
        'default_host',
        'create_command',
        'update_command',
        'delete_command',
    ];

    public function dedicatedServer()
    {
        return $this->belongsTo(DedicatedServer::class, 'ds_id');
    }
}
