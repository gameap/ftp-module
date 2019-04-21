<?php

namespace GameapModules\Ftp\Models;

use Illuminate\Database\Eloquent\Model;
use Gameap\Models\DedicatedServer;
use Gameap\Models\User;

/**
 * Class FtpAccount
 *
 * @package GameapModules\Ftp\Models
 *
 * @property int $id
 * @property int $ds_id
 * @property int $user_id
 * @property string $host
 * @property int $port
 * @property string $username
 * @property string $password
 * @property string $dir
 */
class FtpAccount extends Model
{
    protected $fillable = [
        'ds_id', 'user_id',
        'host', 'port',
        'username', 'password',
        'dir'
    ];

    public function dedicatedServer()
    {
        return $this->belongsTo(DedicatedServer::class, 'ds_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
