<?php

namespace GameapModules\Ftp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Gameap\Http\Controllers\AuthController;
use GameapModules\Ftp\Models\FtpAccount;

class FtpController extends AuthController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('ftp::index', [
            'ftpAccounts' => FtpAccount::paginate(20)
        ]);
    }
}
