<?php

return [
    'title_edit' => "Edit FTP Commands",

    'commands' => 'Commands',

    'default_host' => 'Default Host',

    'create_command' => 'Create Command',
    'update_command' => 'Update Command',
    'delete_command' => 'Delete Command',

    'd_create_command' => 'Shortcodes: {username} — FTP Username, {password} — FTP Password, {dir} — Path to FTP directory',
    'd_update_command' => 'Shortcodes: {username} — FTP Username, {password} — FTP Password, {dir} — Path to FTP directory',
    'd_delete_command' => 'Shortcodes: {username} — FTP Username',

    'update_success_msg' => 'Commands updated successfully',
    'autosetup_started_msg' => 'Autosetup is running. This may take several minutes.',

    'command_examples' => 'Command Examples',
    'examples' => 'Examples',

    'examples_descryption' => '
        <p align="center"><strong>Simple scripts</strong></p>

        <p>Create Command:<br>
            <code>./ftp.sh add --username="{username}" --password="{password}" --directory="{dir}"</code>
        </p>
        <p>Update Command:<br>
            <code>./ftp.sh update --username="{username}" --password="{password}" --directory="{dir}"</code>
        </p>
        <p>Delete Command:<br>
            <code>./ftp.sh delete --username="{username}"</code>
        </p>

        <p>Download scripts from <a target="_blank" href="https://github.com/gameap/scripts/tree/master/ftp">HERE</a> 
        and put them in a working directory on a dedicated server</p>
    ',

    'autosetup' => 'Autosetup',
    'autosetup_confirm_msg' => 'The required packages installation and configuring will be performed. Continue?'
];