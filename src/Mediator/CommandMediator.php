<?php

namespace Evrinoma\FcrBundle\Mediator;

use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractCommandMediator;

class CommandMediator extends AbstractCommandMediator implements CommandMediatorInterface
{
//region SECTION: Public
    public function onUpdate(DtoInterface $dto, $entity): FcrInterface
    {
        return $entity;
    }

    public function onDelete(DtoInterface $dto, $entity): void
    {
    }

    public function onCreate(DtoInterface $dto, $entity): FcrInterface
    {
        return $entity;
    }
//endregion Public
}