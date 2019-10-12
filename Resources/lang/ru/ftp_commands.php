<?php

return [
    'title_edit' => "Редактирование FTP Команд",

    'commands' => 'Команды',

    'default_host' => 'Хост по умолчанию',

    'create_command' => 'Команда создания',
    'update_command' => 'Команда обновления',
    'delete_command' => 'Команда удаления',

    'd_create_command' => 'Шорткоды: {username} — Имя пользователя FTP, {password} — FTP Пароль, {dir} — Путь в каталог FTP аккаунта',
    'd_update_command' => 'Шорткоды: {username} — Имя пользователя FTP, {password} — FTP Пароль, {dir} — Путь в каталог FTP аккаунта',
    'd_delete_command' => 'Шорткоды: {username} — Имя пользователя FTP,',

    'update_success_msg' => 'Команды успешно обновлены',
    'autosetup_started_msg' => 'Автонастройка запущена. Это может занять несколько минут.',

    'command_examples' => 'Примеры команд',
    'examples' => 'Примеры',

    'examples_descryption' => '
        <p align="center"><strong>Простые скрипты</strong></p>

        <p>Команда создания:<br>
            <code>./ftp.sh add --username="{username}" --password="{password}" --directory="{dir}"</code>
        </p>
        <p>Команда обновления:<br>
            <code>./ftp.sh update --username="{username}" --password="{password}" --directory="{dir}"</code>
        </p>
        <p>Команда удаления:<br>
            <code>./ftp.sh delete --username="{username}"</code>
        </p>

        <p>Скачайте скрипты <a target="_blank" href="https://github.com/gameap/scripts/tree/master/ftp">ОТСЮДА</a> и 
        поместите их в рабочий каталог на выделенном сервере</p>
    ',

    'autosetup' => 'Автонастройка',
    'autosetup_confirm_msg' => 'Будет выполнена установка и настройках необходимых пакетов. Продолжить?',
];