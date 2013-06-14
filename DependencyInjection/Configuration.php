<?php

namespace ManneW\HipChatBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('manne_w_hip_chat');

        $rootNode
            ->children()
                ->scalarNode('auth_token')
                    ->info('HipChat API token')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
