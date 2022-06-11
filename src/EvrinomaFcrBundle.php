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

namespace Evrinoma\FcrBundle;

use Evrinoma\FcrBundle\DependencyInjection\Compiler\Constraint\Property\FcrPass;
use Evrinoma\FcrBundle\DependencyInjection\Compiler\DecoratorPass;
use Evrinoma\FcrBundle\DependencyInjection\Compiler\MapEntityPass;
use Evrinoma\FcrBundle\DependencyInjection\EvrinomaFcrExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaFcrBundle extends Bundle
{
    public const FCR_BUNDLE = 'fcr';

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container
            ->addCompilerPass(new MapEntityPass($this->getNamespace(), $this->getPath()))
            ->addCompilerPass(new DecoratorPass())
            ->addCompilerPass(new FcrPass())
        ;
    }

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaFcrExtension();
        }

        return $this->extension;
    }
}
