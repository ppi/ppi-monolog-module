<?php
/**
 * This file is part of the PPI Framework.
 *
 * @copyright   Copyright (c) 2011-2014 Paul Dragoonis <paul@ppi.io>
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        http://www.ppi.io
 */

namespace PPI\MonologModule\ServiceManager;

use PPI\ServiceManager\Config\AbstractConfig;
use Zend\ServiceManager\ServiceManager;

/**
 * ServiceManager configuration for the Monolog module.
 *
 * @author     Vítor Brandão <vitor@ppi.io>
 * @package    PPI
 * @subpackage ServiceManager
 */
class MonologConfig extends AbstractConfig
{
    protected $nestedHandlers = array();

    /**
     * Constructor.
     */
    public function __construct()
    {
        $self = $this;

        $this->config['factories'] = array(

            'monolog.config' => function($serviceManager) use ($self) {
                $configs = $serviceManager->get('Config');

                return $self->processConfiguration($configs, $serviceManager);
            },

            'monolog.logger' => function($serviceManager) use ($self) {
                $config = $serviceManager->get('monolog.config');
                $parameters = $self->getParameters($serviceManager);

                $handlersToChannels = array();

                if (isset($config['handlers'])) {
                    $handlers = array();

                    foreach ($config['handlers'] as $name => $handler) {
                        $handlers[$handler['priority']][] = array(
                            'id'       => $self->buildHandler($serviceManager, $parameters, $name, $handler),
                            'channels' => isset($handler['channels']) ? $handler['channels'] : null
                        );
                    }

                    $sortedHandlers = array();
                    foreach ($handlers as $priorityHandlers) {
                        foreach (array_reverse($priorityHandlers) as $handler) {
                            $sortedHandlers[] = $handler;
                        }
                    }

                    foreach ($sortedHandlers as $handler) {
                        if (!in_array($handler['id'], $self->nestedHandlers)) {
                            $handlersToChannels[$handler['id']] = $handler['channels'];
                        }
                    }
                }

                $loggerClass = $parameters['monolog.logger.class'];
                $logger = new $loggerClass('app');
                foreach ($handlersToChannels as $handler => $channels) {
                    $logger->pushHandler($serviceManager->get($handler));
                }

                return $logger;
            }
        );

        $this->config['aliases'] = array(
            'logger'    => 'monolog.logger'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigurationDefaults()
    {
        return array('monolog' => array());
    }

    protected function buildHandler(ServiceManager $serviceManager, array $parameters, $name, array $handler)
    {
        $handlerId = $this->getHandlerId($name);
        $class = $parameters[sprintf('monolog.handler.%s.class', $handler['type'])];
        $handler['level'] = is_int($handler['level']) ? $handler['level'] : constant('Monolog\Logger::'.strtoupper($handler['level']));

        $serviceManager->setFactory($handlerId, function($serviceManager) use ($class, $handler) {
            switch ($handler['type']) {
            case 'stream':
                return new $class($handler['path'], $handler['level'], $handler['bubble']);
            }

            /*
             * TODO:
             * <code>
             if (!empty($handler['formatter'])) {
                $definition->addMethodCall('setFormatter', array(new Reference($handler['formatter'])));
             }
             */
        });

        return $handlerId;
    }

    protected function getHandlerId($name)
    {
        return sprintf('monolog.handler.%s', $name);
    }

    /**
     * {@inheritDoc}
     */
    protected function processConfiguration(array $configs, ServiceManager $serviceManager = null)
    {
        $alias = $this->getAlias();
        if (!isset($configs[$alias])) {
            return array();
        }

        $parameterBag = $serviceManager->get('config.parameter_bag');
        $config = $configs[$alias];

        if (isset($config['handlers'])) {
            foreach (array_keys($config['handlers']) as $k) {
                if (!isset($config['handlers'][$k]['priority'])) {
                    $config['handlers'][$k]['priority'] = 0;
                }
                if (!isset($config['handlers'][$k]['bubble'])) {
                    $config['handlers'][$k]['bubble'] = true;
                }
                if (isset($config['handlers'][$k]['path'])) {
                    $config['handlers'][$k]['path'] = $parameterBag->resolveString($config['handlers'][$k]['path']);
                }
            }
        }

        return $config;
    }
}
