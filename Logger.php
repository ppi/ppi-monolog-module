<?php
/**
 * This file is part of the PPI Framework.
 *
 * @category    PPI
 * @package     MonologModule
 * @copyright   Copyright (c) 2011-2014 Paul Dragoonis <paul@ppi.io>
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        http://www.ppi.io
 */

namespace PPI\MonologModule;

use Monolog\Logger as BaseLogger;
use PPI\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

/**
 * Logger.
 *
 * @author Vítor Brandão <vitor@ppi.io>
 * @package PPI\MonologModule
 */
class Logger extends BaseLogger implements LoggerInterface, DebugLoggerInterface
{
    /**
     * @see Symfony\Component\HttpKernel\Log\DebugLoggerInterface
     */
    public function getLogs()
    {
        if ($logger = $this->getDebugLogger()) {
            return $logger->getLogs();
        }

        return array();
    }

    /**
     * @see Symfony\Component\HttpKernel\Log\DebugLoggerInterface
     */
    public function countErrors()
    {
        if ($logger = $this->getDebugLogger()) {
            return $logger->countErrors();
        }

        return 0;
    }

    /**
     * Returns a DebugLoggerInterface instance if one is registered with this logger.
     *
     * @return DebugLoggerInterface|null A DebugLoggerInterface instance or null if none is registered
     */
    private function getDebugLogger()
    {
        foreach ($this->handlers as $handler) {
            if ($handler instanceof DebugLoggerInterface) {
                return $handler;
            }
        }
    }
}
