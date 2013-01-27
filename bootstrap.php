<?php
/*
Plugin Name: {{PLUGIN_DISPLAY_NAME}}
Plugin URI: {{PLUGIN_URI}}
Description: {{PLUGIN_DESCRIPTION}}
Version: 1.0
Author: Kevin S. Perrine <kperrine@gmail.com>
Author URI: http://www.kevinsperrine.com/
License: MIT
*/

function {{PLUGIN_NAME}}Autoloader($className)
{
    $paths = array(
        'src/'
    );

    if (stripos($className, "{{PLUGIN_NAMESPACE}}") === false) {
        return;
    }

    foreach ($paths as $path) {
        $filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . $path . str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        if (file_exists($filename)) {
            return require $filename;
        }
    }
}

spl_autoload_register('{{PLUGIN_NAME}}Autoloader');

define('{{PLUGIN_NAMESPACE}}_{{PLUGIN_NAME}}_DIR', dirname(__FILE__));
define('{{PLUGIN_NAMESPACE}}_{{PLUGIN_NAME}}_URL', plugin_dir_url(__FILE__));

$plugin = new {{PLUGIN_NAMESPACE}}_{{PLUGIN_NAME}}_{{PLUGIN_NAME}}(); // PHP 5.2
// $plugin = new {{PLUGIN_NAMESPACE}}\{{PLUGIN_NAME}}\{{PLUGIN_NAME}}(); // PHP 5.3

$plugin->initialize();
