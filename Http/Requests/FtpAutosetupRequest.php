<?php

namespace GameapModules\Ftp\Http\Requests;

use Gameap\Http\Requests\Request;

class FtpAutosetupRequest extends Request
{
    public function rules()
    {
        return [
            'dedicatedServer' => 'required|integer',
        ];
    }
}