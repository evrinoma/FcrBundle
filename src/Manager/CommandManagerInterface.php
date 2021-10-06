<?php

namespace Evrinoma\FcrBundle\Manager;

use Evrinoma\FcrBundle\Exception\FcrCannotBeRemovedException;
use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Exception\FcrInvalidException;
use Evrinoma\FcrBundle\Exception\FcrNotFoundException;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;

interface CommandManagerInterface
{
    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return FcrInterface
     * @throws FcrInvalidException
     */
    public function post(FcrApiDtoInterface $dto): FcrInterface;

    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return FcrInterface
     * @throws FcrInvalidException
     * @throws FcrNotFoundException
     */
    public function put(FcrApiDtoInterface $dto): FcrInterface;

    /**
     * @param FcrApiDtoInterface $dto
     *
     * @throws FcrCannotBeRemovedException
     * @throws FcrNotFoundException
     */
    public function delete(FcrApiDtoInterface $dto): void;
}