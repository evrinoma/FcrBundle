<?php

namespace Evrinoma\FcrBundle\DependencyInjection;

use Evrinoma\FcrBundle\EvrinomaFcrBundle;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


class Configuration implements ConfigurationInterface
{
//region SECTION: Getters/Setters
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder      = new TreeBuilder(EvrinomaFcrBundle::FCR_BUNDLE);
        $rootNode         = $treeBuilder->getRootNode();
        $supportedDrivers = ['orm'];

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('db_driver')
            ->validate()
            ->ifNotInArray($supportedDrivers)
            ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedDrivers))
            ->end()
            ->cannotBeOverwritten()
            ->defaultValue('orm')
            ->end()
            ->scalarNode('factory')->cannotBeEmpty()->defaultValue(EvrinomaFcrExtension::ENTITY_FACTORY_FCR)->end()
            ->scalarNode('entity')->cannotBeEmpty()->defaultValue(EvrinomaFcrExtension::ENTITY_BASE_FCR)->end()
            ->scalarNode('constraints')->defaultTrue()->info('This option is used for enable/disable basic fcr constraints')->end()
            ->scalarNode('dto')->cannotBeEmpty()->defaultValue(EvrinomaFcrExtension::DTO_BASE_FCR)->info('This option is used for dto class override')->end()
            ->arrayNode('decorates')->addDefaultsIfNotSet()->children()
            ->scalarNode('command')->defaultNull()->info('This option is used for command fcr decoration')->end()
            ->scalarNode('query')->defaultNull()->info('This option is used for query fcr decoration')->end()
            ->end()->end()->end();

        return $treeBuilder;
    }
//endregion Getters/Setters
}
