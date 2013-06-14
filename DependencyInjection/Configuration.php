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
            ->end();

        return $treeBuilder;
    }
}
