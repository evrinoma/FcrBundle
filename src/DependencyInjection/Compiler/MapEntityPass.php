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

use Evrinoma\FcrBundle\DependencyInjection\EvrinomaFcrExtension;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractMapEntity;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MapEntityPass extends AbstractMapEntity implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $this->setContainer($container);

        $driver = $container->findDefinition('doctrine.orm.default_metadata_driver');
        $referenceAnnotationReader = new Reference('annotations.reader');

        $this->cleanMetadata($driver, [EvrinomaFcrExtension::ENTITY]);

        $entityFcr = $container->getParameter('evrinoma.fcr.entity');
        if ((str_contains($entityFcr, EvrinomaFcrExtension::ENTITY))) {
            $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/Fcr', '%s/Entity/Fcr');
        }
        $this->addResolveTargetEntity([$entityFcr => [FcrInterface::class => []]], false);
    }
}
