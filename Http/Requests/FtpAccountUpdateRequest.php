<?php

namespace GameapModules\Ftp\Http\Requests;

use Gameap\Http\Requests\Request;

class FtpAccountUpdateRequest extends Request
{
    public function rules()
    {
        return [
            'ds_id' => 'exists:dedicated_servers,id',
            'user_id' => 'exists:users,id',
            'host' => 'required',
            'port' => 'integer',
            'password' => 'required',
            'dir' => 'required'
        ];
    }
}