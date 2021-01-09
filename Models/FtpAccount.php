<?php

namespace GameapModules\Ftp\Models;

use Illuminate\Database\Eloquent\Model;
use Gameap\Models\DedicatedServer;
use Gameap\Models\User;
use Gameap\Traits\Encryptable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 *
 * @property string $link
 */
class FtpAccount extends Model
{
    use Encryptable;

    protected $fillable = [
        'ds_id', 'user_id',
        'host', 'port',
        'username', 'password',
        'dir'
    ];

    protected $encryptable = [
        'password',
    ];

    public function dedicatedServer(): BelongsTo
    {
        return $this->belongsTo(DedicatedServer::class, 'ds_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getLinkAttribute(): string
    {
        $portString = $this->port === 21
            ? ''
            : ":{$this->port}";

        return "ftp://{$this->username}:{$this->password}@{$this->host}{$portString}";
    }
}
