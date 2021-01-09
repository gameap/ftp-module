<?php

namespace GameapModules\Ftp\Exceptions;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FTPCommandNotFoundException extends FtpModuleException
{
    public function render(Request $request): Response
    {
        return redirect()->route('admin.ftp.accounts')
            ->with('error', __('ftp::ftp_accounts.command_not_found_error'));
    }
}
