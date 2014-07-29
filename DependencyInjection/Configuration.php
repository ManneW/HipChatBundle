<?php

namespace Mannew\HipchatBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mannew_hipchat');

        $rootNode
            ->children()
                ->scalarNode('auth_token')
                    ->info('HipChat API token')
                ->end()
                ->booleanNode('verify_ssl')
                    ->defaultTrue()
                    ->info('Set to false if you do not want to verify SSL certificates')
                ->end()
                ->scalarNode('proxy_address')
                    ->defaultNull()
                    ->info('If needed you can specify a proxy that is used when connecting to HipChat.')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
