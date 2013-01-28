# Default Plugin Boilerplate Code

## Code Structure

```
pluginDirectory/
    /css
    /js
        /vendor
    /img
    /scss
    /src
        /namespace
            /pluginname
                pluginname.php
    /tests
    bootstrap.php
    README.md
```

All plugins should follow this directory structure, and be named using PSR-2
naming conventions. If you're writing for PHP 5.3+ then use namespaces, and
build a directory structure around those namespaces to enable use of a PSR-0
autoloader function. For example, if we're writing a plugin to create a custom
post type of Books for use in the WordPress admin, the class may look like this:

### Example PHP 5.3 Class
```
<?php

namespace KevinSPerrine\BookManager;

use KevinSPerrine\Facade\WordPress;

class BookManager
{
    public function __construct(WordPress $facade = null)
    {

    }
}
```

However, if you're writing for PHP < 5.3, then the structure stays the same, but the classes get altered slightly to account for PHP's lack of namespaces in older versions.

### Example PHP 5.2 Class
```
<?php

class KevinSPerrine_BookManager_BookManager
{
    public function __construct(KevinSPerrine_Facade_WordPress $facade = null)
    {

    }
}
```

In either case, the appropriate directory structure is `/src/KevinSPerrine/BookManager/BookManager.php`.

The WordPress plugin tag should be placed in the `bootstrap.php` along a custom autoloader, and other constant declarations. The bootstrap file is responsible for creating the base plugin class and invoking the initialization code.

### Example bootstrap.php
```
<?php
/*
Plugin Name: Book Manager
Plugin URI: {{PLUGIN_URI}}
Description: {{PLUGIN_DESCRIPTION}}
Version: 1.0
Author: Kevin S. Perrine <kperrine@gmail.com>
Author URI: http://www.kevinsperrine.com/
License: MIT
*/

function BookManagerAutoloader($className)
{
    $paths = array(
        'src/'
    );

    if (stripos($className, "KevinSPerrine") === false) {
        return;
    }

    foreach ($paths as $path) {
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }

        $fileName .= dirname(__FILE__) . DIRECTORY_SEPARATOR . $path . str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        if (file_exists($fileName)) {
            require $fileName;
        }
    }
}

spl_autoload_register('BookManagerAutoloader');

define('PLUGINNAME_DIR', dirname(__FILE__));
define('PLUGINNAME_URL', plugin_dir_url(__FILE__));

$plugin = new KevinSPerrine_BookManager_BookManager(); // PHP 5.2
// $plugin = new KevinSPerrine\BookManager\BookManager(); // PHP 5.3

$plugin->initialize();
```

## Styleguide
All PHP must follow PSR-2. The full styleguide can be be found [here](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md), but a few of these are:

* Code MUST use 4 spaces for indenting, not tabs.
* There MUST NOT be a hard limit on line length; the soft limit MUST be 120 characters; lines SHOULD be 80 characters or less.
* There MUST be one blank line after the namespace declaration, and there MUST be one blank line after the block of use declarations.
* Opening braces for classes MUST go on the next line, and closing braces MUST go on the next line after the body.
* Opening braces for methods MUST go on the next line, and closing braces MUST go on the next line after the body.
* Visibility MUST be declared on all properties and methods; abstract and final MUST be declared before the visibility; static MUST be declared after the visibility.
* Control structure keywords MUST have one space after them; method and function calls MUST NOT.
* Opening braces for control structures MUST go on the same line, and closing braces MUST go on the next line after the body.
* Opening parentheses for control structures MUST NOT have a space after them, and closing parentheses for control structures MUST NOT have a space before.