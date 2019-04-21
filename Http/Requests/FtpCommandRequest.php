<?php
/**
 * Created by PhpStorm.
 * User: nikita
 * Date: 4/21/19
 * Time: 4:06 PM
 */

namespace GameapModules\Ftp\Http\Requests;

use Gameap\Http\Requests\Request;

class FtpCommandRequest extends Request
{
    public function rules()
    {
        return [
            'default_host.*' => '',
            'create_command.*' => '',
            'update_command.*' => '',
            'delete_command.*' => '',
        ];
    }
}