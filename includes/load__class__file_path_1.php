<?php

function register($class) {

    $dirs = array('../controller', '../model', '../Util');
    foreach ($dirs as $pasta) {
        if (file_exists("{$pasta}/{$class}.php")) {
            require_once ("{$pasta}/{$class}.php");
        }
    }
}

spl_autoload_register('register');
