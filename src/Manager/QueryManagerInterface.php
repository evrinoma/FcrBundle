<?php

namespace Evrinoma\FcrBundle\Manager;

use Evrinoma\FcrBundle\Exception\FcrProxyException;
use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Exception\FcrNotFoundException;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;

interface QueryManagerInterface
{
    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return array
     * @throws FcrNotFoundException
     */
    public function criteria(FcrApiDtoInterface $dto): array;


    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return FcrInterface
     * @throws FcrNotFoundException
     */
    public function get(FcrApiDtoInterface $dto): FcrInterface;
    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return FcrInterface
     * @throws FcrProxyException
     */
    public function proxy(FcrApiDtoInterface $dto): FcrInterface;
}