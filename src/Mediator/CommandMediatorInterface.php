<?php

namespace Evrinoma\FcrBundle\Mediator;

use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Exception\FcrCannotBeCreatedException;
use Evrinoma\FcrBundle\Exception\FcrCannotBeRemovedException;
use Evrinoma\FcrBundle\Exception\FcrCannotBeSavedException;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;

interface CommandMediatorInterface
{
    /**
     * @param FcrApiDtoInterface $dto
     * @param FcrInterface       $entity
     *
     * @return FcrInterface
     * @throws FcrCannotBeSavedException
     */
    public function onUpdate(FcrApiDtoInterface $dto, FcrInterface $entity): FcrInterface;

    /**
     * @param FcrApiDtoInterface $dto
     * @param FcrInterface       $entity
     *
     * @throws FcrCannotBeRemovedException
     */
    public function onDelete(FcrApiDtoInterface $dto, FcrInterface $entity): void;

    /**
     * @param FcrApiDtoInterface $dto
     * @param FcrInterface       $entity
     *
     * @return FcrInterface
     * @throws FcrCannotBeSavedException
     * @throws FcrCannotBeCreatedException
     */
    public function onCreate(FcrApiDtoInterface $dto, FcrInterface $entity): FcrInterface;
}