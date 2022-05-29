<?php

namespace Evrinoma\FcrBundle\PreValidator;

use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Exception\FcrInvalidException;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;

interface DtoPreValidatorInterface
{
    /**
     * @param FcrApiDtoInterface $dto
     *
     * @throws FcrInvalidException
     */
    public function onPost(FcrApiDtoInterface $dto): void;

    /**
     * @param FcrApiDtoInterface $dto
     *
     * @throws FcrInvalidException
     */
    public function onPut(FcrApiDtoInterface $dto): void;

    /**
     * @param FcrApiDtoInterface $dto
     *
     * @throws FcrInvalidException
     */
    public function onDelete(FcrApiDtoInterface $dto): void;
}