<?php

call_user_func(
    function () {
        if (!is_file($autoloadFile = __DIR__ . '/../vendor/autoload.php')) {
            throw new \LogicException('vendor/autoload.php not found. Did you run "composer install --dev"?');
        }

        require_once $autoloadFile;

        $manne = new \Manne\HipChatBundle\ManneHipChatBundle();
    }
);
