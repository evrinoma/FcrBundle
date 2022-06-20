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

namespace Evrinoma\FcrBundle\Mediator;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractCommandMediator;

class CommandMediator extends AbstractCommandMediator implements CommandMediatorInterface
{
    public function onUpdate(DtoInterface $dto, $entity): FcrInterface
    {
        /* @var $dto FcrApiDtoInterface */
        $entity
            ->setDescription($dto->getDescription())
            ->setId($dto->Id()->toInt())
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setActive($dto->getActive());

        return $entity;
    }

    public function onDelete(DtoInterface $dto, $entity): void
    {
        $entity
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setActiveToDelete();
    }

    public function onCreate(DtoInterface $dto, $entity): FcrInterface
    {
        /* @var $dto FcrApiDtoInterface */
        $entity
            ->setDescription($dto->getDescription())
            ->setId($dto->Id()->toInt())
            ->setCreatedAt(new \DateTimeImmutable())
            ->setActiveToActive();

        return $entity;
    }
}
