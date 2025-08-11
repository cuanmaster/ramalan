<?php

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
chdir(FCPATH);

// Load our paths config file
// This is the line that might need to be changed, depending upon your folder structure.
require FCPATH . '../app/Config/Paths.php';
$paths = new Config\Paths();

// Location of the framework bootstrap file.
$bootstrap = rtrim($paths->systemDirectory, '/ ') . '/bootstrap.php';

if (! is_file($bootstrap)) {
    http_response_code(503);
    echo 'System bootstrap file not found.';
    exit(1);
}

require $bootstrap;

// Now load the framework constants and Common.php
$app = Config\Services::codeigniter();
$app->run();