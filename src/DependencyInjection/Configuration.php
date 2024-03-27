<?php

declare(strict_types=1);

namespace Skynettechnologies\SyliusAllinOneAccessibilityPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('skynettechnologies_sylius_allinoneaccessibility_plugin');

        $rootNode = $treeBuilder->getRootNode();

        /**
         * @psalm-suppress UndefinedMethod
         */
        $rootNode
            ->children()
                ->scalarNode('slider')->defaultValue('swiper')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
