<?php
session_start();

$configFile = __DIR__ . '/config/database.php';

/*
|--------------------------------------------------------------------------
| Already Installed?
|--------------------------------------------------------------------------
*/

if (file_exists($configFile)) {

    $config = require $configFile;

    if (!empty($config['host'])) {

        die("
        <h2 style='font-family:Segoe UI'>
        ✅ FinCore is already installed.<br><br>
        Delete install.php if you no longer need it.
        </h2>
        ");

    }

}

/*
|--------------------------------------------------------------------------
| Show Installer Form
|--------------------------------------------------------------------------
*/

require __DIR__ . '/views/install.view.php';
