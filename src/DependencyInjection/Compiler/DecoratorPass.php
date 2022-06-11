<?php

namespace Evrinoma\FcrBundle\DependencyInjection\Compiler;



use Evrinoma\FcrBundle\EvrinomaFcrBundle;
use Symfony\Component\DependencyInjection\Compiler\AbstractRecursivePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DecoratorPass extends AbstractRecursivePass
{

    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $decoratorQuery = $container->getParameter('evrinoma.'.EvrinomaFcrBundle::FCR_BUNDLE.'.decorates.query');
        if ($decoratorQuery) {
            $queryMediator = $container->getDefinition($decoratorQuery);
            $repository    = $container->getDefinition('evrinoma.'.EvrinomaFcrBundle::FCR_BUNDLE.'.repository');
            $repository->setArgument(2, $queryMediator);
        }
        $decoratorCommand = $container->getParameter('evrinoma.'.EvrinomaFcrBundle::FCR_BUNDLE.'.decorates.command');
        if ($decoratorCommand) {
            $commandMediator = $container->getDefinition($decoratorCommand);
            $commandManager  = $container->getDefinition('evrinoma.'.EvrinomaFcrBundle::FCR_BUNDLE.'.command.manager');
            $commandManager->setArgument(3, $commandMediator);
        }
        $decoratorPreValidator = $container->getParameter('evrinoma.'.EvrinomaFcrBundle::FCR_BUNDLE.'.decorates.pre.validator');
        if ($decoratorPreValidator) {
            $preValidator  = $container->getDefinition($decoratorPreValidator);
            $apiController = $container->getDefinition('evrinoma.'.EvrinomaFcrBundle::FCR_BUNDLE.'.api.controller');
            $apiController->setArgument(5, $preValidator);
        }
    }
}