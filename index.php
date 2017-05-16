<?php
date_default_timezone_set("Asia/Jakarta");
error_reporting(1);
define('ENVIRONMENT', 'development');
$system_path = 'codemiring';
$application_folder = 'system';
if (defined('STDIN')) {
    chdir(dirname(__FILE__));
}
if (realpath($system_path) !== FALSE) {
    $system_path = realpath($system_path) . '/';
}
$system_path = rtrim($system_path, '/') . '/';
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('EXT', '.php');
define('BASEPATH', str_replace("\\", "/", $system_path));
define('FCPATH', str_replace(SELF, '', __FILE__));
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));
if (is_dir($application_folder)) {
    define('APPPATH', $application_folder . '/');
} else {
    define('APPPATH', BASEPATH . $application_folder . '/');
}
require_once BASEPATH . 'core/CodeMiring.php';
