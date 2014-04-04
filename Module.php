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

use PPI\Autoload;
use PPI\Module\AbstractModule;

/**
 * PPI Monolog Module.
 *
 * @author Vítor Brandão <vitor@ppi.io>
 */
class Module extends AbstractModule
{
    const VERSION = '0.0.1-DEV';

    /**
     * {@inheritDoc}
     */
    public function init($e)
    {
        Autoload::add(__NAMESPACE__, dirname(__DIR__));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'PPIMonologModule';
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return array();
    }
}
