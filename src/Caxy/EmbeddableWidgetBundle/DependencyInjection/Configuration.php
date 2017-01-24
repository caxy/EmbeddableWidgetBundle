<?php

namespace Caxy\EmbeddableWidgetBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('caxy_embeddable_widget');

        $rootNode
            ->children()
                ->arrayNode('widgets')
                    ->useAttributeAsKey('type')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('html')->end()
                            ->scalarNode('js')->defaultNull()->end()
                            ->scalarNode('css')->defaultNull()->end()
                        ->end()
                    ->end()
                ->end()


            ->end()
        ;

        return $treeBuilder;
    }
}
