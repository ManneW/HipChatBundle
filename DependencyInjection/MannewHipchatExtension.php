<?php

namespace Mannew\HipchatBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class MannewHipchatExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('hipchat.xml');

        if (!isset($config['auth_token'])) {
            throw new \InvalidArgumentException(
                'The "auth_token" must be set'
            );
        }

        $container->setParameter(
            'mannew_hipchat.auth_token',
            $config['auth_token']
        );
    }
}
