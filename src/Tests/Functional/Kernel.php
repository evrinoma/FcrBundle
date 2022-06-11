<?php

namespace Evrinoma\FcrBundle\Tests\Functional;

use Evrinoma\TestUtilsBundle\Kernel\AbstractApiKernel;

/**
 * Kernel
 */
class Kernel extends AbstractApiKernel
{

    protected string $bundlePrefix = 'FcrBundle';
    protected string $rootDir = __DIR__;


    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        return array_merge(parent::registerBundles(), [new \Evrinoma\DtoBundle\EvrinomaDtoBundle(), new \Evrinoma\FcrBundle\EvrinomaFcrBundle()]);
    }

    protected function getBundleConfig(): array
    {
        return  ['framework.yaml', 'jms_serializer.yaml'];
    }

}
