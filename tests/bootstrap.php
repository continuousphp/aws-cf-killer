<?php

chdir(dirname(__DIR__));

if (is_file($autoload = getcwd() . '/vendor/autoload.php')) {
    require $autoload;
}
if (!class_exists('Continuous\Aws\Killer\ApplicationFactory', true)) {
    if (is_file($autoload = __DIR__ . '/../vendor/autoload.php')) {
        require($autoload);
    } elseif (is_file($autoload = __DIR__ . '/../../../autoload.php')) {
        require($autoload);
    } else {
        fwrite(
            STDERR,
            'You must set up the project dependencies, run the following commands:'.PHP_EOL.
            'curl -s http://getcomposer.org/installer | php'.PHP_EOL.
            'php composer.phar install'.PHP_EOL
        );
        exit(1);
    }
}
