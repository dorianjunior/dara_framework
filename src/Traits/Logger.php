<?php

namespace App\Traits;

use Monolog\Logger as MonoLogger;
use Monolog\Handler\StreamHandler;

trait Logger {
    protected static $logger;

    public static function getLogger() {
        if (!self::$logger) {
            self::$logger = new MonoLogger('app');
            self::$logger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/app.log', MonoLogger::DEBUG));
        }
        return self::$logger;
    }
}
