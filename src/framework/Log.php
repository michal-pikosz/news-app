<?php

namespace src\framework;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use RuntimeException;

/**
*
* Class for logging information
* @package src\framework
*
* A simple class implementing the singleton pattern
* allows logging data to a different file
* level of information validity
*
*/

class Log {

    protected static ?Logger $instance = null;

    /**
     * Method to return the Monolog instance
     *
     * @return Logger
     */
    public static function getLogger(): ?Logger
    {
        if (static::$instance === null) {
            self::configureInstance();
        }

        return self::$instance;
    }

    /**
     * Configure Monolog to use a rotating files system.
     *
     * @return void
     */
    protected static function configureInstance(): void
    {
        $dir = dirname(__DIR__) . "/../storage/log";

        if (!file_exists($dir) && !mkdir($dir, 0777, true) && !is_dir($dir)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $dir));
        }

        $logger = new Logger('main');
        $logger->pushHandler(new RotatingFileHandler($dir . DIRECTORY_SEPARATOR . 'main.log', 5));
        self::$instance = $logger;
    }

    /**
     * @param $message
     * @param array $context
     */
    public static function debug($message, array $context = []): void
    {
        self::getLogger()->debug($message, $context);
    }

    /**
     * @param $message
     * @param array $context
     */
    public static function info($message, array $context = []): void
    {
        self::getLogger()->info($message, $context);
    }

    /**
     * @param $message
     * @param array $context
     */
    public static function notice($message, array $context = []): void
    {
        self::getLogger()->notice($message, $context);
    }

    /**
     * @param $message
     * @param array $context
     */
    public static function warning($message, array $context = []): void
    {
        self::getLogger()->warning($message, $context);
    }

    /**
     * @param $message
     * @param array $context
     */
    public static function error($message, array $context = []): void
    {
        self::getLogger()->error($message, $context);
    }

    /**
     * @param $message
     * @param array $context
     */
    public static function critical($message, array $context = []): void
    {
        self::getLogger()->critical($message, $context);
    }

    /**
     * @param $message
     * @param array $context
     */
    public static function alert($message, array $context = []): void
    {
        self::getLogger()->alert($message, $context);
    }

    /**
     * @param $message
     * @param array $context
     */
    public static function emergency($message, array $context = []): void
    {
        self::getLogger()->emergency($message, $context);
    }

}
