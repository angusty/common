<?php
function loadClass($class)
{
    $file = __DIR__ . '/class/' . $class . '.php';
    if (file_exists($file)) {
        require $file;
    }
}
spl_autoload_register('loadClass', true, true);
