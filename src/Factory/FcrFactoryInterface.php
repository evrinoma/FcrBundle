<?php

namespace Evrinoma\FcrBundle\Factory;

use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;

interface FcrFactoryInterface
{
    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return FcrInterface
     */
    public function create(FcrApiDtoInterface $dto): FcrInterface;
}