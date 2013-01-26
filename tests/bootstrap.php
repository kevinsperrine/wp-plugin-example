<?php

function {{PLUGIN_NAME}}Autoloader($className)
{
    $paths = array(
        '../src/'
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