<?php

namespace Evrinoma\FcrBundle;

use Evrinoma\FcrBundle\DependencyInjection\Compiler\DecoratorPass;
use Evrinoma\FcrBundle\DependencyInjection\Compiler\MapEntityPass;
use Evrinoma\FcrBundle\DependencyInjection\EvrinomaFcrExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaFcrBundle extends Bundle
{
//region SECTION: Fields
    public const FCR_BUNDLE = 'fcr';
//endregion Fields
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container
            ->addCompilerPass(new MapEntityPass($this->getNamespace(), $this->getPath()))
            ->addCompilerPass(new DecoratorPass())
        ;
    }
//region SECTION: Getters/Setters
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaFcrExtension();
        }

        return $this->extension;
    }
//endregion Getters/Setters


}