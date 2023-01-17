<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'name' => 'admin.ftp', 'middleware' => 'isAdmin'], function () {
    Route::name('admin.ftp')->get('ftp', 'FtpController@index');

    Route::name('admin.ftp')->resource('ftp/accounts', 'FtpAccountsController', [
        'as' => 'admin',
        'parameters' => ['accounts' => 'ftp_account'],
    ]);

    Route::name('admin.ftp.accounts.last_error')
        ->get('ftp/last_error', 'FtpAccountsController@lastError');

    Route::name('admin.ftp.commands.edit')->get('ftp/commands/edit', 'FtpCommandsController@edit');
    Route::name('admin.ftp.commands.update')->patch('ftp/commands', 'FtpCommandsController@update');

    Route::name('admin.ftp.commands.autosetup')
        ->post('ftp/autosetup', 'FtpCommandsController@autosetup');
});
