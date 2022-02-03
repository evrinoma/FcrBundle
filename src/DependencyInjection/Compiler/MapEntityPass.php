<?php

namespace Evrinoma\FcrBundle\DependencyInjection\Compiler;

use Evrinoma\FcrBundle\DependencyInjection\EvrinomaFcrExtension;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractMapEntity;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MapEntityPass extends AbstractMapEntity implements CompilerPassInterface
{
//region SECTION: Public
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $this->setContainer($container);

        $driver                    = $container->findDefinition('doctrine.orm.default_metadata_driver');
        $referenceAnnotationReader = new Reference('annotations.reader');

        $this->cleanMetadata($driver, [EvrinomaFcrExtension::ENTITY]);

        $entityFcr = $container->getParameter('evrinoma.fcr.entity');
        if ((strpos($entityFcr, EvrinomaFcrExtension::ENTITY) !== false)) {
            $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/Fcr', '%s/Entity/Fcr');
        }
        $this->addResolveTargetEntity([$entityFcr => [FcrInterface::class => [],],], false);
    }


//endregion Private
}