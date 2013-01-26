<?php
/*
Plugin Name: {{PLUGIN_NAME}}
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

define('{{PLUGIN_NAMESACE}}_{{PLUGIN_NAME}}_DIR', dirname(__FILE__));
define('{{PLUGIN_NAMESACE}}_{{PLUGIN_NAME}}_URL', plugin_dir_url(__FILE__));

$plugin = new C3_PluginName_PluginName();

$plugin->initialize();
