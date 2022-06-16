<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\FcrBundle\DependencyInjection\Compiler;

use Evrinoma\FcrBundle\EvrinomaFcrBundle;
use Symfony\Component\DependencyInjection\Compiler\AbstractRecursivePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DecoratorPass extends AbstractRecursivePass
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $decoratorQuery = $container->getParameter('evrinoma.'.EvrinomaFcrBundle::FCR_BUNDLE.'.decorates.query');
        if ($decoratorQuery) {
            $queryMediator = $container->getDefinition($decoratorQuery);
            $repository = $container->getDefinition('evrinoma.'.EvrinomaFcrBundle::FCR_BUNDLE.'.repository');
            $repository->setArgument(2, $queryMediator);
        }
        $decoratorCommand = $container->getParameter('evrinoma.'.EvrinomaFcrBundle::FCR_BUNDLE.'.decorates.command');
        if ($decoratorCommand) {
            $commandMediator = $container->getDefinition($decoratorCommand);
            $commandManager = $container->getDefinition('evrinoma.'.EvrinomaFcrBundle::FCR_BUNDLE.'.command.manager');
            $commandManager->setArgument(3, $commandMediator);
        }
    }
}
